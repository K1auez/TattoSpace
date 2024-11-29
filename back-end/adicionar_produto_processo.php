<?php
session_start();
include '../conexao.php';

// Verifica se o usuário é admin
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['is_admin'] == true) {
    // Pega os dados do formulário
    $produto_nome = $_POST['produto_nome'];
    $produto_preco = $_POST['produto_preco'];
    $produto_img = 'img/' . basename($_FILES['produto_img']['name']);

    // Faz o upload da imagem para a pasta 'images/'
    move_uploaded_file($_FILES['produto_img']['tmp_name'], '../' . $produto_img);

    // Insere o produto no banco de dados
    $sql = "INSERT INTO produtos (produto_nome, produto_preco, produto_img) VALUES ('$produto_nome', '$produto_preco', '$produto_img')";

    if ($conexao->query($sql) === TRUE) {
        echo "<script>alert('Produto adicionado com sucesso!');</script>";
        header("Location: ../index.php");
    } else {
        echo "Erro ao adicionar o produto: " . $conexao->error;
    }
} else {
    echo "Acesso negado. Somente administradores podem adicionar produtos.";
}

$conexao->close();
?>