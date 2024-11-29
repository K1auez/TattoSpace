<?php
session_start();
include './conexao.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Tattoo Space</title>
</head>
<body>
    <div class="home">
    <div class="header">
        <div class="logo">
            <img src="">
        </div>
        <div class="links">
        <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    echo '<div class="btn-a">';
                    echo '<a class="btn-sair" href="./assets/back-end/logout.php"><ion-icon name="exit-outline"></ion-icon><span>Sair</span></a>';
                    echo '<a class="btn-carrinho" href="./carrinho.php"><ion-icon name="cart-outline"></ion-icon>Carrinho</a>';
                    echo '</div>';
                } else {
                    echo '<a href="autenticacao.php">Login</a>';
                    echo '<a href="autenticacao.php">Cadastre-se</a>';
                }
            ?>
        </div>
    </div>
    </div>

    <div class="all-products">
                    <?php
                    $sql = "SELECT * FROM produtos";
                    $result = $conexao->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $produto_id = $row['produto_id'];
                            $produto_nome = $row['produto_nome'];
                            $produto_preco = $row['produto_preco'];
                            $produto_img = $row['produto_img'];
                            
                            echo "<a href='detalhes.php?id=$produto_id'>";
                            echo "<div class='product'>";
                            echo "<img src='$produto_img'>";
                            echo "<div class='product-info' id='$produto_id'>";
                            echo "<h4 class='product-title'>$produto_nome</h4>";
                            echo "<p class='product-price'>R$ $produto_preco</p>";

                            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                if ($_SESSION["is_admin"] == true) {
                                    echo "<div class='admin-options'>";
                                    echo "<a href='./editar_produto.php?id=$produto_id' class='btn-edit'>Editar</a>";
                                    echo "<a href='./assets/back-end/deletar_produto.php?id=$produto_id' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja deletar este produto?\")'>Deletar</a>";
                                    echo "</div>";
                                } else {
                                    echo "<form method='POST' action='./assets/back-end/adicionar_carrinho.php'>";
                                    echo "<input type='hidden' name='produto_id' value='$produto_id'>";
                                    echo "<button type='submit'>Adicionar ao carrinho</button>";
                                    echo "</form>";
                                }
                            } else {}
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</a>";
                        }
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                            if ($_SESSION["is_admin"] == true) {
                                echo "<div class='product'>";
                                echo "<a href='./adicionar_produto.php' class='btn-add'>Adicionar</a>";
                                echo "</div>";
                            } else {}} else {}
                    } else {
                        echo "Nenhum produto encontrado.";
                    }
                    ?>
        </div>

    <div class="footer"></div>
</body>
</html>