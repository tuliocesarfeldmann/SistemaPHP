<?php
    require_once("db_config.php");
    include_once("helpers.php");

    session_start();

    // Verifica se a sessão do usuário está ativa && a role do usuário é "A": Administrador
    if (!isset($_SESSION["user_id"])) {
        // Se a sessão não estiver ativa, redireciona para a página de login
        header("Location: login.php");
        exit;
    }

    if($_SESSION["role"] != 'A') {
        echo("<!DOCTYPE html><html><head><title>Login</title><link rel=\"stylesheet\" type=\"text/css\" href=\"styles/dashboard_style.css\"></head>
              <body><h1 align=center>Acesso não autorizado</h1></body></html>");
        exit();
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: login.php");
        exit;
    }

    if(isset($_POST["deleteItem"])){
      $queryProduct = "UPDATE products SET deleted = 1 WHERE id = :product_id;";
      $stmtProduct = $pdo->prepare($queryProduct);
      $stmtProduct->bindParam("product_id", $_POST["product_id"]);
      $stmtProduct->execute();

      setPopup(PopupTypes::SUCCESS, "Produto excluído com sucessor!");
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar itens do site</title>
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

    <?php
        $nameFilter =  "%" . ($_GET["search"] ?? "") . "%";
        

        $queryProducts = "SELECT p.*, i.image FROM products p 
            INNER JOIN images i on i.id = p.image_id 
            WHERE UPPER(p.name) like UPPER(:nameFilter)
            AND p.deleted = 0";

        $stmtProducts = $pdo->prepare($queryProducts);
        $stmtProducts->bindParam("nameFilter", $nameFilter);
        $stmtProducts->execute();
        $products = $stmtProducts->fetchAll();

        echo("<div class=\"productListing\">");
        foreach($products as $product) {
            createProductCardAdmin($product["id"], $product["name"], $product["price"], $product["image"]);
        }
        echo("</div>");
    ?>
</body>
</html>
