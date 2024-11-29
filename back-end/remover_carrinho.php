<?php
session_start();
include '../conexao.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $carrinho_id = $_POST['carrinho_id'];

    // Remove o produto do carrinho
    $sql = "DELETE FROM carrinho WHERE carrinho_id = $carrinho_id";

    if ($conexao->query($sql) === TRUE) {
        header("Location: ../carrinho.php");
    } else {
        echo "Erro ao remover produto: " . $conexao->error;
    }
} else {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: ../autenticacao.php");
}
?>