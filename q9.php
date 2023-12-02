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
        <h1>Questão 9</h1>
        <h3>Cite a quantidade de produtos vendidos com e sem promoção separados por dia.</h3>
        <br><br>

        <table>
        <tr>
            <th>Data venda</th>
            <th>Quantidade com promoção</th>
            <th>Quantidade sem promoção</th>
        </tr>

    <?php

        $query = "SELECT
            DATE(s.sale_date) AS DATA,
            SUM(CASE WHEN EXISTS(SELECT * FROM promocao pr WHERE pr.data_inicio <= DATE(s.sale_date) AND pr.data_fim >= DATE(s.sale_date) AND pr.product_id = sd.product_id) THEN sd.quantity ELSE 0 END) AS QUANTIDADE_COM_PROMOCAO,
            SUM(CASE WHEN NOT EXISTS(SELECT * FROM promocao pr WHERE pr.data_inicio <= DATE(s.sale_date) AND pr.data_fim >= DATE(s.sale_date) AND pr.product_id = sd.product_id) THEN sd.quantity ELSE 0 END) AS QUANTIDADE_SEM_PROMOCAO
        FROM sale_details sd
        JOIN sale s ON s.id = sd.sale_id
        GROUP BY DATA        
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach($results as $result) {
            echo("<tr>");
            echo("<td>" . $result["DATA"] . "</td>");
            echo("<td>" . $result["QUANTIDADE_COM_PROMOCAO"] . "</td>");
            echo("<td>" . $result["QUANTIDADE_SEM_PROMOCAO"] . "</td>");
            echo("</tr>");
        }

    ?>

        </table>
    </div>
</body>
</html>