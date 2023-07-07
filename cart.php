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
                        WHERE c.buyer_id = :buyer_id");
    $stmt->bindParam(':buyer_id', $userId);
    $stmt->execute();
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
    }

    if(isset($_POST["confirm_purchase"])){
        try {
            $pdo->beginTransaction();

            $totalPrice = getTotalPrice($cartItems);
            
            $query = "INSERT INTO sale (buyer_id, total_price) VALUES (:buyer_id, :total_price)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":buyer_id", $_SESSION["user_id"]);
            $stmt->bindParam(":total_price", $totalPrice);
            $stmt->execute();

            $saleId = $pdo->lastInsertId();
    
            foreach($cartItems as $cartItem){
                $query = "INSERT INTO sale_details (product_id, quantity, sale_id) VALUES (:product_id, :quantity, :sale_id)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":product_id", $cartItem['product_id']);
                $stmt->bindParam(":quantity", $cartItem['quantity']);
                $stmt->bindParam(":sale_id", $saleId);
                $stmt->execute();
            }
    
            setPopup(PopupTypes::SUCCESS, "Compra efetuada com sucesso! O ID da sua venda é: " . $saleId);
    
            $query = "DELETE FROM cart WHERE buyer_id = :buyer_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':buyer_id', $_SESSION['user_id']);
            $stmt->execute();

            $cartItems = array();

            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            setPopup(PopupTypes::ERROR, "Erro ao confirmar a compra: " . $e->getMessage());
        }
    }

    function formatPrice($price) {
        return number_format($price, 2, ',', '.');
    }

    function getTotalPrice($cartItems){
        return array_reduce($cartItems, function($acum, $item) {
            $price = floatval($item['price']);
            $quantity = $item['quantity'];
            $subtotal = $price * $quantity;
            return $acum + $subtotal;
        }, 0);
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
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
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
                foreach ($cartItems as $cartItem):
                    $cartItemId = $cartItem['cart_id'];
                    $cartItemName = $cartItem['name'];
                    $cartItemPrice = floatval($cartItem['price']);
                    $cartItemQuantity = $cartItem['quantity'];
                    $cartItemTotalPrice = formatPrice($cartItemPrice * $cartItemQuantity);
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
                TOTAL: R$ <?= formatPrice(getTotalPrice($cartItems)); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <button type="submit" name="confirm_purchase">Confirmar Compra</button>
        </form>
    </div>

</body>
</html>