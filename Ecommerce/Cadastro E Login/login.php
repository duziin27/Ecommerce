<?php
require_once('../Mysql.php');

// Conexão com o banco de dados
$conexao = Mysql::conexao();
if ($conexao->connect_error) {
    die("A conexão falhou: " . $conexao->connect_error);
}

if (isset($_POST['Email']) || isset($_POST['Senha'])) {

    if (strlen($_POST['Email']) == 0) {
        echo "<p>Preencha o campo E-mail</p>";
    } elseif (strlen($_POST['Senha']) == 0) {
        echo "<p>Preencha o campo Senha</p>";
    } else {

        $email = $conexao->real_escape_string($_POST['Email']);
        $senha = $conexao->real_escape_string($_POST['Senha']);

        $sql = "SELECT * FROM clientes WHERE Email = '$email'";
        $result = $conexao->query($sql) or die("Falha na execução: " . $conexao->error);

        if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();
            if (password_verify($senha, $cliente["Senha"])) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION["usuario"] = $cliente["Nome_cliente"];
                $_SESSION["usuarioId"] = $cliente["Id_cadastro"];

                header("Location: ../Produtos/Produtos.php");
                exit();
            } else {
                echo '<p class="mensagem-erro">Falha ao logar! Senha incorreta</p>';

            }
        } else {
            echo '<p class="mensagem-erro">Falha ao logar! E-mail incorreto</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="formulario">
        <form action="" method="post">
            <h2>Login</h2>
            <input type="email" id="email" name="Email" placeholder="Email" required><br><br>
            <input type="password" id="senha" name="Senha" placeholder="Senha" required><br><br>

            <br><br>

            <button type="submit">Entrar</button>

            <br><br>
            Não possui cadastro? <a href="cadastro.php">Clique aqui</a> e faça agora mesmo!
        </form>
    </div>
</body>


</html>