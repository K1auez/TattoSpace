<?php
session_start();
include 'conexao.php';

// Verifica se o usuário está logado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $usuario_id = $_SESSION['usuario_id'];

    // Seleciona os itens do carrinho do usuário logado
    $sql = "SELECT c.carrinho_id, p.produto_nome, p.produto_preco, c.quantidade
            FROM carrinho c
            JOIN produtos p ON c.produto_id = p.produto_id
            WHERE c.usuario_id = $usuario_id";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Seu Carrinho</h2>";
        while ($row = $result->fetch_assoc()) {
            $carrinho_id = $row['carrinho_id'];
            $produto_nome = $row['produto_nome'];
            $produto_preco = $row['produto_preco'];
            $quantidade = $row['quantidade'];

            echo "<div class='cart-item'>";
            echo "<p>Produto: $produto_nome</p>";
            echo "<p>Preço: R$ $produto_preco</p>";
            echo "<p>Quantidade: $quantidade</p>";

            echo "<form method='POST' action='./assets/back-end/remover_carrinho.php'>";
            echo "<input type='hidden' name='carrinho_id' value='$carrinho_id'>";
            echo "<button type='submit'>Remover</button>";
            echo "</form>";

            echo "</div>";
        }
    } else {
        echo "Seu carrinho está vazio.";
    }
} else {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: autenticacao.php");
}
?>