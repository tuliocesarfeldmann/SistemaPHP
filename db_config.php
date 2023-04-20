<?php
    $host = 'localhost';
    $dbname = 'trabalho_php';

    $username = 'root';
    $password = 'admin';

    // Conecta ao banco de dados usando PDO
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch(PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        exit;
    }
?>