<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
    }

    require 'db_config.php';

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $endereco = $_POST['endereco'];
        $nome = $_POST['nome'];
        $cep = $_POST['cep'];
        $cidade_estado = $_POST['cidadeEstado'];
        $salt = md5(uniqid(rand(), true));

        $passwordHash = password_hash($password.$salt, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (email, password, salt, role, nome, endereco, cep, cidade_estado) VALUES (:email, :password, :salt, :role, :nome, :endereco, :cep, :cidade_estado)";
        $stmt = $pdo->prepare($query);
        $role = 'U';
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':salt', $salt);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':cidade_estado', $cidade_estado);

        try {
            $stmt->execute();
            $message = "Usuário criado com sucesso!";
        } catch(PDOException $e) {
            $message = "Houve um problema ao criar o usuário: ". $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="styles/login_style.css">
</head>
<body>
    <?php if(!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="register.php" method="post">
        <p>CADASTRO</p>
        <input type="text" name="email" placeholder="Digite seu email">
        <input type="password" name="password" placeholder="Digite sua senha">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <input type="text" name="endereco" placeholder="Digite seu endereço">
        <input type="text" name="cep" placeholder="Digite seu cep">
        <input type="text" name="cidadeEstado" placeholder="Cidade - estado">
        <input type="submit" value="Cadastrar">

        <a href="login.php">Voltar ao login</a>
    </form>
</body>
</html>
