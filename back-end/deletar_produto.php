<?php
session_start();
include '../conexao.php';

// Verifica se o usuário é admin
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['is_admin'] == true) {
    $produto_id = $_GET['id'];

    // Deleta o produto do banco de dados
    $sql = "DELETE FROM produtos WHERE produto_id = $produto_id";

    if ($conexao->query($sql) === TRUE) {
        echo "<script>alert('Produto deletado com sucesso!');</script>";
        header("Location: ../index.php");
    } else {
        echo "Erro ao deletar o produto: " . $conexao->error;
    }
} else {
    echo "Acesso negado. Somente administradores podem deletar produtos.";
}

$conexao->close();
?>