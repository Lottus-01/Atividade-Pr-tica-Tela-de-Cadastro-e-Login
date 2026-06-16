<?php
require 'conexao.php';

$mensagem = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];

    if(empty($nome) || empty($email) || empty($senha) || empty($confirmar)){
        $mensagem = "Preencha todos os campos.";
    }

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $mensagem = "E-mail inválido.";
    }

    elseif($senha !== $confirmar){
        $mensagem = "As senhas não coincidem.";
    }

    else{

        $verifica = $pdo->prepare(
            "SELECT id FROM usuarios WHERE email = ?"
        );

        $verifica->execute([$email]);

        if($verifica->rowCount() > 0){
            $mensagem = "E-mail já cadastrado.";
        } else {

            $senhaHash = password_hash(
                $senha,
                PASSWORD_DEFAULT
            );

            $sql = $pdo->prepare(
                "INSERT INTO usuarios(nome,email,senha)
                 VALUES(?,?,?)"
            );

            $sql->execute([
                $nome,
                $email,
                $senhaHash
            ]);

            $mensagem = "Cadastro realizado com sucesso!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Cadastro</h2>

<p><?= $mensagem ?></p>

<form method="POST">

<input type="text" name="nome" placeholder="Nome">

<input type="email" name="email" placeholder="E-mail">

<input type="password" name="senha" placeholder="Senha">

<input type="password" name="confirmar" placeholder="Confirmar senha">

<button type="submit">Cadastrar</button>

</form>

<a href="login.php">Já possui conta?</a>

</div>

</body>
</html>