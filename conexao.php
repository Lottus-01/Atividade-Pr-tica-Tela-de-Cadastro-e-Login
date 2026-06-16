<?php

$host = "localhost";
$user = "root";
$password = "root";
$database = "sistema_login";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>