
<link rel="stylesheet" type="text/css" href="styles/navbar_style.css">

<nav class="navbar">
    <img src="images/logo.jpg">
    <a class=<?php echo(($_PAGE_TITLE == "Comprar") ? "selected" : "unselected")?> href="index.php">Comprar</a>
    <a class=<?php echo(($_PAGE_TITLE == "Vender") ? "selected" : "unselected")?> href="sell.php">Vender</a>
 
    <button class="options"><img src="images/down-triangle.png"></button>
    <span class="username"><?php echo($_SESSION["nome"])?></span>
</nav>