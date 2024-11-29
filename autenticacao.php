<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="autenticacao.css">
    <title>KPROG</title>
</head>
<body>
    <div class="container">
        <div class="login">
        <form action="./back-end/login_processo.php" method="post">
            <span>Entre com seu email e senha</span>
            <input type="text" id="username" name="username" placeholder="Endereço de email">
            <input type="password" id="password" name="password" placeholder="Senha">
            <button type="submit">Continuar</button>
        </form>
        <a href="redefinir.php">Esqueceu a senha? Clique aqui</a>
        <a href="cadastro.php">Não tem uma conta? Clique aqui</a>
        </div>


        <div class="cadastro">
        <form action="./back-end/cadastro_processo.php" method="post">
            <span>Cadastre-se abaixo</span>
            <input type="text" name="nome" placeholder="Nome de usuário">
            <input type="email" name="email" placeholder="Endereço de email">
            <input type="password" name="senha" placeholder="Senha">
            <button type="submit">Continuar</button>
        </form>
        <a href="login.php">Já tem uma conta? Clique aqui</a>
        </div>

    </div>
</body>
</html>