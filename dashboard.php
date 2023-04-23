<?php
    $_PAGE_TITLE = "Administrar";

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
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo($_PAGE_TITLE)?></title>
   
</head>
<body>
    <?php include_once("menu.php");?>

    <p>DASHBOARD WORKS!!</p>

    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>
