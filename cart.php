<?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    include 'db_config.php';
    include 'helpers.php';

    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT c.id as cart_id, p.id as product_id, p.name, p.price, i.image, c.quantity
                        FROM cart c
                        INNER JOIN products p ON c.product_id = p.id
                        INNER JOIN images i on i.id = p.image_id
                        WHERE c.seller_id = ?");
    $stmt->execute([$userId]);
    $cartItems = $stmt->fetchAll();

    if(isset($_POST["update_quantity"])){
        $cartId = $_POST["cart_id"];
    
        if($_POST["update_quantity"] === "+"){
            $newQuantity = $_POST["quantity"] + 1;
        } else if($_POST["update_quantity"] === "-"){
            $newQuantity = $_POST["quantity"] - 1;

        }

        if($newQuantity > 0){
            $query = "UPDATE cart SET quantity = :newQuantity WHERE id = :cartId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':newQuantity', $newQuantity);
            $stmt->bindParam(':cartId', $cartId);
            $stmt->execute();
        } else {
            $query = "DELETE FROM cart WHERE id = :cartId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':cartId', $cartId);
            $stmt->execute();
        }

        header("Refresh: 0");
        exit;
    }
    

    function formatPrice($price) {
        return number_format($price, 2, ',', '.');
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Carrinho de Compras</title>
  <link rel="stylesheet" type="text/css" href="styles/menu_style.css">
  <link rel="stylesheet" type="text/css" href="styles/cart_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css"></link>
</head>
<body>

    <?php include 'menu.php'; ?>

    <?php showPopup(); ?>

    <div class="cart-container">
        <h1>Carrinho de Compras</h1>

        <?php if (empty($cartItems)): ?>
            <p>Seu carrinho está vazio.</p>
        <?php else: ?>
            <?php
                $totalPrice = 0;
                foreach ($cartItems as $cartItem):
                    $cartItemId = $cartItem['cart_id'];
                    $cartItemName = $cartItem['name'];
                    $cartItemPrice = floatval($cartItem['price']);
                    $cartItemQuantity = $cartItem['quantity'];
                    $cartItemTotalPrice = formatPrice($cartItemPrice * $cartItemQuantity);
                    $totalPrice += $cartItemPrice * $cartItemQuantity;
                    $cartItemPrice = formatPrice($cartItemPrice);
            ?>
                <div class="cart-item">
                    <img src="data:image/jpeg;base64,<?= base64_encode($cartItem['image']) ?>" alt="IMG">
                    <span><?= $cartItemName ?></span> 
                    <span>R$ <?= $cartItemPrice ?></span> 
                    <span>
                        <form method="POST">
                            <input type="hidden" name="cart_id" value="<?= $cartItemId ?>">
                            <button type="submit" name="update_quantity" value="-">-</button>
                            <input type="number" name="quantity" value="<?= $cartItemQuantity ?>" min="1" max="10">
                            <button type="submit" name="update_quantity" value="+">+</button>
                        </form>
                    </span>
                    <span>R$ <?= $cartItemTotalPrice ?></span> 
                </div>
            <?php endforeach; ?>
            <div>
                TOTAL: R$ <?= formatPrice($totalPrice) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="cart_action.php">
            <input type="hidden" name="action" value="confirm_purchase">
            <button type="submit">Confirmar Compra</button>
        </form>
    </div>

</body>
</html>