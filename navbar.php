
<link rel="stylesheet" type="text/css" href="styles/navbar_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar">
    <img src="images/logo.jpg">
    <a class=<?php echo(($_PAGE_TITLE == "Comprar") ? "selected" : "unselected")?> href="index.php">Comprar</a>
    <a class=<?php echo(($_PAGE_TITLE == "Vender") ? "selected" : "unselected")?> href="sell.php">Vender</a>
    <div class="search">
        <form>
        <input type="text" placeholder="Pesquisar..." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
 
    <button class="options"><img src="images/down-triangle.png"></button>
    <span class="username"><?php echo($_SESSION["nome"])?></span>
</nav>