<?php
session_start();
include './conexao.php';

// Verifica se o usuário é admin
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['is_admin'] == true) {
    $produto_id = $_GET['id'];

    // Pega os dados do produto atual
    $sql = "SELECT * FROM produtos WHERE produto_id = $produto_id";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $produto_nome = $row['produto_nome'];
        $produto_preco = $row['produto_preco'];
        $produto_img = $row['produto_img'];
    } else {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "Acesso negado. Somente administradores podem editar produtos.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
    <h2>Editar Produto</h2>
    <form method="POST" action="./assets/back-end/editar_produto_processo.php" enctype="multipart/form-data">
        <input type="hidden" name="produto_id" value="<?php echo $produto_id; ?>">
        <label for="produto_nome">Nome do Produto:</label>
        <input type="text" id="produto_nome" name="produto_nome" value="<?php echo $produto_nome; ?>" required><br>

        <label for="produto_preco">Preço do Produto:</label>
        <input type="text" id="produto_preco" name="produto_preco" value="<?php echo $produto_preco; ?>" required><br>

        <label for="produto_img">Imagem do Produto:</label>
        <input type="file" id="produto_img" name="produto_img"><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>