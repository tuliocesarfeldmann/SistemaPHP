<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        header("Location: index.php");
    }

    require 'db_config.php';

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $endereco = $_POST['endereco'];
        $username = $_POST['username'];
        $cep = $_POST['cep'];
        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $birthdate = $_POST['birthdate'];
        $rg = $_POST['rg'];
        $salt = md5(uniqid(rand(), true));

        $passwordHash = password_hash($password.$salt, PASSWORD_BCRYPT);

        $pdo->beginTransaction();

        $queryLocalidade = "SELECT id FROM localidade WHERE cep_inicial <= :cep AND cep_final >= :cep;";
        $stmtLocalidade = $pdo->prepare($queryLocalidade);
        $stmtLocalidade->bindParam(':cep', $cep);
        $stmtLocalidade->execute();
        $idLocalidade = $stmtLocalidade->fetch();

        $query = "INSERT INTO users (email, password, salt, role, username, address, cep, localidade_id) VALUES (:email, :password, :salt, :role, :username, :endereco, :cep, :localidade_id)";
        $stmt = $pdo->prepare($query);
        $role = 'U';
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':salt', $salt);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':localidade_id', $idLocalidade["id"]);

        try {
            $stmt->execute();

            $userId = $pdo->lastInsertId();

            $queryCPF = "INSERT INTO user_cpf (name, cpf, birthdate, rg, users_id) VALUES (:name, :cpf, :birthdate, :rg, :users_id)";
            $stmtCPF = $pdo->prepare($queryCPF);
            $stmtCPF->bindParam(':name', $name);
            $stmtCPF->bindParam(':cpf', $cpf);
            $stmtCPF->bindParam(':birthdate', $birthdate);
            $stmtCPF->bindParam(':rg', $rg);
            $stmtCPF->bindParam(':users_id', $userId);

            $stmtCPF->execute();

            $pdo->commit();

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
    <link rel="stylesheet" type="text/css" href="styles/authentication_style.css">
</head>
<body>
    <?php if(!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <p>CADASTRO</p>
        <input type="text" name="email" placeholder="Digite seu email">
        <input type="password" name="password" placeholder="Digite sua senha">
        <input type="text" name="username" placeholder="Digite seu username">
        <input type="text" name="endereco" placeholder="Digite seu endereço">
        <input type="text" name="cep" placeholder="Digite seu cep">
        <input type="text" name="name" placeholder="Digite seu nome completo">
        <input type="text" name="cpf" placeholder="Digite seu cpf">
        <input type="text" name="birthdate" placeholder="Digite seu nascimento (YYYY-MM-DD)">
        <input type="text" name="rg" placeholder="Digite seu RG">
        <input type="submit" value="Cadastrar">

        <a href="login.php">Voltar ao login</a>
    </form>
</body>
</html>
