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
        // Listar itens vendidos do vendedor
        $querySales = "SELECT p.name, p.price, SUM(quantity) as quantity FROM sale_details sd
                        JOIN products p ON p.id = sd.product_id
                        WHERE p.seller_id = :seller_id
                        GROUP BY p.name, p.price;";

        $stmtSales = $pdo->prepare($querySales);
        $stmtSales->bindParam("seller_id", $_SESSION["user_id"]);
        $stmtSales->execute();
        $sales = $stmtSales->fetchAll();

        echo("<div class=\"reportTable dFlex\">");
        echo("<table>");
        echo("<tr> <th class=\"thName\">Descrição</th> <th class=\"thQuantity\">Quantidade vendida</th> <th class=\"thValue\">Valor total vendido</th>");

        foreach($sales as $sale) {
          echo("<tr>");

          echo("<td class=\"tdName\">". $sale["name"] ."</td>");
          echo("<td class=\"tdQuantity\">". $sale["quantity"] ."</td>");
          echo("<td class=\"tdValue\">R$ ". number_format($sale["quantity"] * $sale["price"], 2, ',', '.')  ."</td>");

          echo("</tr>");
        }

        echo("</table>");
        echo("</div");
    ?>
    
</body>
</html>