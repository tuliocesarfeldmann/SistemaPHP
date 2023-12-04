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
        <h1>Questão 6</h1>
        <h3>Crie uma promoção para todos os produtos de uma categoria de um vendedor.</h3>
        <br><br>

        <form method="post">
            <p>Digite a data de início da promoção (yyyy-mm-dd)</p>
            <input type="text" name="inicio">
            <p>Digite a data de fim da promoção (yyyy-mm-dd)</p>
            <input type="text" name="fim">
            <p>Digite o percentual de desconto</p>
            <input type="number" name="percentual" step="0.01">
            <p>Digite o ID do vendedor</p>
            <input type="text" name="vendedor" placeholder="teste@gmail.com">
            <p>Digite o ID da categoria do produto</p>
            <input type="text" name="categoria" placeholder="teste@gmail.com">
            <button type="submit">Alterar</button>
        </form>
    </div>

    <?php
        $inicio = ($_POST["inicio"] ?? "");
        $fim = ($_POST["fim"] ?? "");
        $percentual = ($_POST["percentual"] ?? "");
        $vendedor = ($_POST["vendedor"] ?? "");
        $categoria = ($_POST["categoria"] ?? "");

        $query = "INSERT INTO promocao (data_inicio, data_fim, percentual_desconto, product_id) (
            SELECT :inicio, :fim, :percentual, p.id 
            FROM products p 
            JOIN users u ON u.id = p.seller_id 
            WHERE p.seller_id = :vendedor 
            AND p.categoria_id = :categoria 
            )";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam("inicio", $inicio);
        $stmt->bindParam("fim", $fim);
        $stmt->bindParam("percentual", $percentual);
        $stmt->bindParam("vendedor", $vendedor);
        $stmt->bindParam("categoria", $categoria);
        $stmt->execute();

    ?>
</body>
</html>