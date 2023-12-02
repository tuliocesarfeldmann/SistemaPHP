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
        <h1>Questão 10</h1>
        <h3>Cite o nome do usuário, o tipo (físico ou jurídico), o nome da localidade, a quantidade total e o valor total de vendas feitas por dia ordenados pelo nome do usuário em ordem alfabética e pela data.</h3>
        <br><br>

        <table>
        <tr>
            <th>Nome usuário</th>
            <th>Data</th>
            <th>Tipo</th>
            <th>Localidade</th>
            <th>Quantidade total</th>
            <th>Valor total</th>
        </tr>

    <?php

        $query = "SELECT
            DATE(S.SALE_DATE) DATA,
            S1.USERNAME,
            S1.TYPE TIPO,
            L.LOCALIDADE,
            SUM(SD.QUANTITY) QUANTIDADE_TOTAL,
            SUM(S.TOTAL_PRICE) VALOR_TOTAL
        FROM (
            SELECT
                U.ID,
                U.USERNAME,
                U.LOCALIDADE_ID,
                'CNPJ' AS TYPE
            FROM USERS U
            JOIN USER_CNPJ UCNPJ ON UCNPJ.USERS_ID = U.ID
            UNION
            SELECT
                U.ID,
                U.USERNAME,
                U.LOCALIDADE_ID,
                'CPF' AS TYPE
            FROM USERS U
            JOIN USER_CPF UCPF ON UCPF.USERS_ID = U.ID
        ) AS S1
        JOIN LOCALIDADE L ON L.ID = S1.LOCALIDADE_ID
        JOIN SALE S ON S.BUYER_ID = S1.ID
        JOIN SALE_DETAILS SD ON SD.SALE_ID = S.ID
        GROUP BY S1.USERNAME, DATE(S.SALE_DATE), TIPO, L.LOCALIDADE
        ORDER BY S1.USERNAME, DATE(S.SALE_DATE)       
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach($results as $result) {
            echo("<tr>");
            echo("<td>" . $result["USERNAME"] . "</td>");
            echo("<td>" . $result["DATA"] . "</td>");
            echo("<td>" . $result["TIPO"] . "</td>");
            echo("<td>" . $result["LOCALIDADE"] . "</td>");
            echo("<td>" . $result["QUANTIDADE_TOTAL"] . "</td>");
            echo("<td>" . $result["VALOR_TOTAL"] . "</td>");
            echo("</tr>");
        }

    ?>

        </table>
    </div>
</body>
</html>