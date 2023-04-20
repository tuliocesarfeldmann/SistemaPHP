<?php
    $_PAGE_TITLE = "Comprar";

    session_start();

    // Verifica se a sessão do usuário está ativa
    if (!isset($_SESSION['user_id'])) {
        // Se a sessão não estiver ativa, redireciona para a página de login
        header("Location: login.php");
        exit;
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo($_PAGE_TITLE)?></title>
    <link rel="stylesheet" type="text/css" href="styles/dashboard_style.css">
</head>
<body>
    <?php include_once("navbar.php");?>

    <p>DASHBOARD WORKS!!</p>

    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>