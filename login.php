<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        echo(isset($_SESSION['user_id']));
        header("Location: index.php");
    }

    require 'db_config.php';

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT id, email, password, salt, role, nome FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user === false) {
            $message = "O email ou a senha estão incorretos!";
        } else {
            $validPassword = password_verify($password.$user['salt'], $user['password']);

            if($validPassword) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
            } else {
                $message = "O email ou a senha estão incorretos!";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles/authentication_style.css">
</head>
<body>
    <?php if(!empty($message)): ?>
        <p class="error"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <p>LOGIN</p>
        <input type="text" name="email" placeholder="Digite seu email">
        <input type="password" name="password" placeholder="Digite sua senha">
        <input type="submit" value="Entrar">

        <a href="register.php">Cadastrar-se</a>
    </form>
    
</body>
</html>
