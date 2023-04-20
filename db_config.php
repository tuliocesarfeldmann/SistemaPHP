<?php
    $host = 'localhost';
    $dbname = 'trabalho_php';

    $username = 'root';
    $password = '#A1b2c3d4e5f6#';

    // Conecta ao banco de dados usando PDO
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch(PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        exit;
    }
?>