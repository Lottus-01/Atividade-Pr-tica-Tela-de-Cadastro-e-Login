<?php
session_start();
require 'conexao.php';

$mensagem = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $sql = $pdo->prepare(
        "SELECT * FROM usuarios WHERE email = ?"
    );

    $sql->execute([$email]);

    if($sql->rowCount() == 1){

        $usuario = $sql->fetch();

        if(password_verify(
            $senha,
            $usuario['senha']
        )){

            session_regenerate_id(true);

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: home.php");
            exit;
        }
    }

    $mensagem = "E-mail ou senha inválidos.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Login</h2>

<p><?= $mensagem ?></p>

<form method="POST">

<input type="email" name="email" placeholder="E-mail">

<input type="password" name="senha" placeholder="Senha">

<button type="submit">Entrar</button>

</form>

<a href="cadastro.php">Criar conta</a>

</div>

</body>
</html>