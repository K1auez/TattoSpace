<?php
session_start();
include '../conexao.php';

// Verifica se o usuário é admin
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['is_admin'] == true) {
    $produto_id = $_POST['produto_id'];
    $produto_nome = $_POST['produto_nome'];
    $produto_preco = $_POST['produto_preco'];

    // Verifica se foi feita uma nova upload de imagem
    if (!empty($_FILES['produto_img']['name'])) {
        $produto_img = 'img/' . basename($_FILES['produto_img']['name']);
        move_uploaded_file($_FILES['produto_img']['tmp_name'], '../' . $produto_img);

        // Atualiza o produto com a nova imagem
        $sql = "UPDATE produtos SET produto_nome = '$produto_nome', produto_preco = '$produto_preco', produto_img = '$produto_img' WHERE produto_id = $produto_id";
    } else {
        // Atualiza o produto sem modificar a imagem
        $sql = "UPDATE produtos SET produto_nome = '$produto_nome', produto_preco = '$produto_preco' WHERE produto_id = $produto_id";
    }

    if ($conexao->query($sql) === TRUE) {
        echo "<script>alert('Produto editado com sucesso!');</script>";
        header("Location: ../index.php");
    } else {
        echo "Erro ao editar o produto: " . $conexao->error;
    }
} else {
    echo "Acesso negado. Somente administradores podem editar produtos.";
}

$conexao->close();
?>