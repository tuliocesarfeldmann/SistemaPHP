<?php
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

    echo($_SESSION['nome']);
    echo($_SESSION['role']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles/dashboard_style.css">
</head>
<body>
    <p>DASHBOARD WORKS!!</p>

    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>
