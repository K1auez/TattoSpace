<?php
include '../conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']); // Criptografe a senha para segurança

$sql = "INSERT INTO cadastro (cadastro_nome, cadastro_email, cadastro_senha) VALUES ('$nome', '$email', '$senha')";

if ($conexao->query($sql) === TRUE) {
    header("Location: ../autenticacao.php"); // Redireciona para a página de login
} else {
    echo "Erro: " . $sql . "<br>" . $conexao->error;
}

$conexao->close();
?>