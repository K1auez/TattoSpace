<?php
//conecta ao banco de dados
$conexao = new mysqli("localhost", "root", "", "bd_tattoo"); // 1 sempre host, 2 sempre root se estiver usando phpmyadmin, 3 sempre senha, 4 sempre nome da pasta de ligacao no phpmyadmin

//verifica se a conexão foi bem-sucedida
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

?>