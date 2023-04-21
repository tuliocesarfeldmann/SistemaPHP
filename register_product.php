<?php
    require_once("db_config.php");
    include_once("helpers.php");

    session_start();

    // Verifica se a sessão do usuário está ativa
    if (!isset($_SESSION['user_id'])) {
        // Se a sessão não estiver ativa, redireciona para a página de login
        header("Location: login.php");
        exit;
    }

    if(isset($_POST["registerProduct"])) {

        // Se estiver faltando algum campo, exibir mensagem de erro
        if(!isset($_POST["productName"]) || !isset($_POST["price"]) || !isset($_FILES["image"])) {
            setPopup(PopupTypes::ERROR, "É necessário preencher todos os campos para cadastrar um produto");
        } else { // Se não, cadastrar produto 
            $productName = $_POST["productName"];
            $price = $_POST["price"];
            $image = $_FILES["image"];
            $imageType = $image["type"];
            $imageName = $image["name"];
            $imageBlob = file_get_contents($image["tmp_name"]);

            $queryImage = "INSERT INTO images (image, name, type) VALUES (:image, :name, :type);";
            $stmtImage = $pdo->prepare($queryImage);
            $stmtImage->bindParam("image", $imageBlob);
            $stmtImage->bindParam("name", $imageName);
            $stmtImage->bindParam("type", $imageType);
            $stmtImage->execute();
            $imageId = $pdo->lastInsertId();

            $queryProduct = "INSERT INTO products (name, price, seller_id, image_id) VALUES (:name, :price, :seller_id, :image_id);";
            $stmtProduct = $pdo->prepare($queryProduct);
            $stmtProduct->bindParam("name", $productName);
            $stmtProduct->bindParam("price", $price);
            $stmtProduct->bindParam("seller_id", $_SESSION["user_id"]);
            $stmtProduct->bindParam("image_id", $imageId);
            $stmtProduct->execute();

            setPopup(PopupTypes::SUCCESS, "Produto salvo com sucesso");
        }


    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comprar itens</title>
    <link rel="stylesheet" type="text/css" href="styles/index_style.css">
    <link rel="stylesheet" type="text/css" href="styles/menu_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css"></link>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <?php showPopup(); ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="productName" placeholder="Digite o nome do produto">
        <input type="number" name="price" placeholder="Digite o preço do produto" required>
        <input type="file" name="image" accept="image/*" required>

        <input type="submit" name="registerProduct">
    </form>

</body>
</html>