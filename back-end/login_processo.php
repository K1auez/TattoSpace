<?php
session_start();
include '../conexao.php';

$email = $_POST['username']; 
$senha = md5($_POST['password']);

// Consulta para verificar se o usuário é administrador
$sql = "SELECT * FROM cadastro WHERE cadastro_email = '$email' AND cadastro_senha = '$senha' AND is_admin = 1";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $_SESSION["loggedin"] = true;
    $_SESSION["is_admin"] = true; 
    header("Location: ../index.php");
} else {
    // Consulta para verificar se o usuário é um usuário regular
    $sql = "SELECT * FROM cadastro WHERE cadastro_email = '$email' AND cadastro_senha = '$senha' AND is_admin = 0";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["loggedin"] = true;
        $_SESSION["is_admin"] = false;
        $_SESSION['usuario_id'] = $row['cadastro_id'];
 
        header("Location: ../index.php");
    } else {
        print "<script>alert('Email ou senha incorretos');</script>";
        print "<script>location.href='../autenticacao.php';</script>";
    }
}

$conexao->close();
?>
