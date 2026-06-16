<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Home</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Parabens você lembra a sua senha</h1>

<h2><?= htmlspecialchars($_SESSION['nome']) ?></h2>

<a href="logout.php">
    Sair
</a>

</div>

</body>
</html>