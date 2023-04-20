<?php
    session_start();
    include 'db_config.php';

    if (!empty($_POST['senha_antiga']) && !empty($_POST['nova_senha']) && !empty($_POST['nova_senha_confirm'])) {

        // Verifica se as senhas novas são iguais
        if ($_POST['nova_senha'] !== $_POST['nova_senha_confirm']) {

            echo "<script>var senhasDiferentes = 'As senhas não são iguais';</script>";

        } else {
            // Obter a senha antiga armazenada no banco para o usuário atualmente logado
            $stmt = $pdo->prepare("SELECT password, salt FROM users WHERE id = :user_id");
            $stmt->bindParam(":user_id", $_SESSION['user_id']);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Comparar a senha antiga fornecida pelo usuário com a senha armazenada no banco
            if (password_verify($_POST['senha_antiga'].$usuario['salt'], $usuario['password'])) {
                $novaSenha = $_POST['nova_senha'];
                $novoSalt = md5(uniqid(rand(), true));

                $novaSenhaHash = password_hash($novaSenha.$novoSalt, PASSWORD_BCRYPT);

                $query = "UPDATE users set password = :novaSenha, salt = :novoSalt WHERE id = :user_id";
                $stmt = $pdo->prepare($query);

                $stmt->bindParam(':novaSenha', $novaSenhaHash);
                $stmt->bindParam(':novoSalt', $novoSalt);
                $stmt->bindParam(':user_id', $_SESSION['user_id']);

                $stmt->execute();

                echo "<script>var senhaAlterada = 'Senha alterada com sucesso';</script>";
            } else {
                echo "<script>var senhaAntigaIncorreta = 'Senha antiga informada está incorreta';</script>";
            }

        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alterar senha</title>
    <link rel="stylesheet" type="text/css" href="styles/authentication_style.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <p>ALTERAR SENHA</p>
        <input type="password" name="senha_antiga" placeholder="Digite sua senha antiga" required>

        <input type="password" name="nova_senha" placeholder="Digite sua nova senha" required>

        <input type="password" placeholder="Confirme sua nova senha" name="nova_senha_confirm" required>

        <input type="submit" value="Salvar">

        <a href="index.php">Voltar</a>
    </form>
    <script>
        $(document).ready(function() {
            if (typeof senhasDiferentes !== 'undefined') {
                toastr.error(senhasDiferentes);
            } else if (typeof senhaAlterada !== 'undefined') {
                toastr.success(senhaAlterada);
            } else if (typeof senhaAntigaIncorreta !== 'undefined'){
                toastr.error(senhaAntigaIncorreta);
            }
        });
    </script>
</body>
</html>
