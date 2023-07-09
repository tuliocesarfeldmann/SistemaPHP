<?php

    if(isset($_GET['logout']) && $_GET['logout'] == 'true') {
        session_destroy();
        header('Location: login.php');
        exit;
    }

?>

<nav>

    <a href="index.php"><img class="logo" src="images/logo.jpg"></a>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
        <input type="text" name="search" placeholder="Busque sua oferta">
        <button type="submit">Buscar</button>
    </form>
    <div class="profile-container">
        <span><?php echo $_SESSION['nome']; ?></span>
        <div class="profile-menu">
            <button class="profile-btn"><i class="fa fa-cog"></i></button>
            <div class="profile-dropdown">
                <?php
                if($_SESSION["role"] == 'A') {
                    echo('<a href="dashboard.php">Dashboard Admin</a>');
                }
                ?>
                <a href="change_password.php">Alterar senha</a>
                <a href="sales.php">Minhas vendas</a>
                <a href="cart.php">Meu carrinho</a>
                <a href="?logout=true">Sair</a>
            </div>
        </div>
    </div>
</nav>