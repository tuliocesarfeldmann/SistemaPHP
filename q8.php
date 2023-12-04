<?php
    require_once("db_config.php");
    include_once("helpers.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comprar itens</title>
    <link rel="stylesheet" type="text/css" href="styles/index_style.css">
    <link rel="stylesheet" type="text/css" href="styles/menu_style.css">
</head>
<body>

    <div style="width: 100vw;" class="registerProductForm">
        <h1>Questão 8</h1>
        <h3>Liste a localidade dos compradores dos produtos mais vendidos por categoria e a quantidade de produtos.</h3>
        <br><br>

        <table>
        <tr>
            <th>Localidade</th>
            <th>Categoria</th>
            <th>Quantidade Vendidos</th>
        </tr>

    <?php

        $query = "SELECT
                l.localidade AS LOCALIDADE,
                c.tipo AS CATEGORIA,
                SUM(sd.quantity) AS QUANTIDADE
            FROM sale_details sd
            JOIN products p ON sd.product_id = p.id
            JOIN categoria c ON p.categoria_id = c.id
            JOIN sale s ON sd.sale_id = s.id
            JOIN users u ON s.buyer_id = u.id
            JOIN localidade l ON u.localidade_id = l.id
            GROUP BY l.localidade, c.tipo
            ORDER BY QUANTIDADE DESC
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach($results as $result) {
            echo("<tr>");
            echo("<td>" . $result["LOCALIDADE"] . "</td>");
            echo("<td>" . $result["CATEGORIA"] . "</td>");
            echo("<td>" . $result["QUANTIDADE"] . "</td>");
            echo("</tr>");
        }

    ?>

        </table>
    </div>
</body>
</html>