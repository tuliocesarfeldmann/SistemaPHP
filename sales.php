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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comprar itens</title>
    <link rel="stylesheet" type="text/css" href="styles/index_style.css">
    <link rel="stylesheet" type="text/css" href="styles/menu_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css"></link>
</head>
<body>
    <?php include 'menu.php'; ?>

    
    <?php
        //Exibir itens a venda desse usuário
        $nameFilter =  "%" . ($_GET["search"] ?? "") . "%";
        

        $queryProducts = "SELECT p.*, i.image FROM products p 
            INNER JOIN images i on i.id = p.image_id 
            WHERE p.seller_id = :seller_id and UPPER(p.name) like UPPER(:nameFilter)";

        $stmtProducts = $pdo->prepare($queryProducts);
        $stmtProducts->bindParam("seller_id", $_SESSION["user_id"]);
        $stmtProducts->bindParam("nameFilter", $nameFilter);
        $stmtProducts->execute();
        $products = $stmtProducts->fetchAll();

        echo("<div class=\"productListing\">");
        foreach($products as $product) {
            createProductCard($product["id"], $product["name"], $product["price"], $product["image"]);
        }
        echo("</div>");
    ?>
    
    <a href="register_product.php">Cadastrar Produto</a>
    
</body>
</html>