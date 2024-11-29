<?php
session_start();
include './conexao.php';

// Verifica se o usuário é admin
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['is_admin'] == true) {
    // Exibe o formulário de adicionar produto
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
</head>
<body>
    <h2>Adicionar Novo Produto</h2>
    <form method="POST" action="./back-end/adicionar_produto_processo.php" enctype="multipart/form-data">
        <label for="produto_nome">Nome do Produto:</label>
        <input type="text" id="produto_nome" name="produto_nome" required><br>

        <label for="produto_preco">Preço do Produto:</label>
        <input type="text" id="produto_preco" name="produto_preco" required><br>

        <label for="produto_img">Imagem do Produto:</label>
        <input type="file" id="produto_img" name="produto_img" required><br>

        <button type="submit">Adicionar Produto</button>
    </form>
</body>
</html>

<?php
} else {
    echo "Acesso negado. Somente administradores podem adicionar produtos.";
    exit;
}
?>