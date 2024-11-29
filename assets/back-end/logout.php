<?php
include '../conexao.php';
session_start();

// Destrói todas as variáveis de sessão
$_SESSION = array();

// Se você quiser destruir a sessão completamente, remova também o cookie de sessão.
// Isso fará com que a sessão seja destruída, assim como todos os dados associados a ela.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destrói a sessão
session_destroy();

// Redireciona para a página inicial
header("Location: ../index.php");
exit();

?>