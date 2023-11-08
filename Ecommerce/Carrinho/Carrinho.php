<?php
require_once('Mysql.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Cadastro E Login/login.php");
    exit;
}

$conexao = Mysql::conexao();
if ($conexao->connect_error) {
    die("A conexão falhou: " . $conexao->connect_error);
}

if(isset($_POST['add_carrinho'])){

    $nome_produto = mysqli_real_escape_string($conexao, $_POST['Nome_produto']);
    $preco = mysqli_real_escape_string($conexao, $_POST['Preco']);
    $quantidade = mysqli_real_escape_string($conexao, $_POST['quantidade
    ']);

}

?>