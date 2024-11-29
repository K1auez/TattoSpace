<?php
session_start();
include '../conexao.php';

// Verifica se o usuário está logado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $usuario_id = $_SESSION['usuario_id'];
    $produto_id = $_POST['produto_id'];

    // Verifica se o produto já está no carrinho
    $sql = "SELECT * FROM carrinho WHERE usuario_id = $usuario_id AND produto_id = $produto_id";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        // Se o produto já estiver no carrinho, atualiza a quantidade
        $sql = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE usuario_id = $usuario_id AND produto_id = $produto_id";
    } else {
        // Se o produto não estiver no carrinho, insere um novo registro
        $sql = "INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES ($usuario_id, $produto_id, 1)";
    }

    if ($conexao->query($sql) === TRUE) {
        header("Location: ../carrinho.php"); // Redireciona para a página do carrinho
    } else {
        echo "Erro ao adicionar ao carrinho: " . $conexao->error;
    }
} else {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: ../autenticacao.php");
}
?>