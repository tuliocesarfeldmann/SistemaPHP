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
        <h1>Questão 2</h1>
        <h3>Altere um usuário já existente para Administrador a partir do email.</h3>

        <br><br>
        <p>Digite o email do usário do qual você deseja alterar para administrador</p>
        <form method="post">
            <input type="text" name="email" placeholder="teste@gmail.com">
            <button type="submit">Alterar</button>
        </form>
    </div>

    <?php
        $email = ($_POST["email"] ?? "");

        $query = "UPDATE users u
            SET u.role = 'A'
            WHERE u.email = :email";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam("email", $email);
        $stmt->execute();
        //$products = $stmt->fetchAll();

    ?>
</body>
</html>