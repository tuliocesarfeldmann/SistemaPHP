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
        <h1>Questão 7</h1>
        <h3>Liste a quantidade de usuário pessoa física e jurídica cadastrados por localidade. Mostre o nome da localidade e a quantidade de usuários por tipo.</h3>
        <br><br>

        <table>
        <tr>
            <th>Localidade</th>
            <th>Quantidade CPF</th>
            <th>Quantidade CNPJ</th>
        </tr>

    <?php

        $query = "SELECT
                L.LOCALIDADE,
                SUM(CASE WHEN S1.TYPE = 'CPF' THEN 1 ELSE 0 END) QUANTIDADE_CPF,
                SUM(CASE WHEN S1.TYPE = 'CNPJ' THEN 1 ELSE 0 END) QUANTIDADE_CNPJ
            FROM (
                SELECT
                    U.ID,
                    U.LOCALIDADE_ID,
                    'CNPJ' AS TYPE
                FROM USERS U
                JOIN USER_CNPJ UCNPJ ON UCNPJ.USERS_ID = U.ID
                UNION
                SELECT
                    U.ID,
                    U.LOCALIDADE_ID,
                    'CPF' AS TYPE
                FROM USERS U
                JOIN USER_CPF UCPF ON UCPF.USERS_ID = U.ID
            ) AS S1
            JOIN LOCALIDADE L ON L.ID = S1.LOCALIDADE_ID
            GROUP BY L.LOCALIDADE";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach($results as $result) {
            echo("<tr>");
            echo("<td>" . $result["LOCALIDADE"] . "</td>");
            echo("<td>" . $result["QUANTIDADE_CPF"] . "</td>");
            echo("<td>" . $result["QUANTIDADE_CNPJ"] . "</td>");
            echo("</tr>");
        }

    ?>

        </table>
    </div>
</body>
</html>