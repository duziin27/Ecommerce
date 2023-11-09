<?php
require_once('../Mysql.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Cadastro E Login/login.php");
    exit;
}

$conexao = Mysql::conexao();
if ($conexao->connect_error) {
    die("A conexão falhou: " . $conexao->connect_error);
}

if (isset($_GET['finalizar'])) {
    $id = $_GET['finalizar'];
    $consulta = "UPDATE carrinho SET Estado = 'Finalizado' WHERE Id_cadastro = $id";
    $resultado = $conexao->query($consulta);
};

if (isset($_GET['delete'])) {
    $remove_id = $_GET['delete'];
    $consulta = "DELETE FROM carrinho WHERE id = '$remove_id'";
    $resultado = $conexao->query($consulta);
}

if (isset($_POST['atualizar'])) {
    $usuarioId = $_SESSION['usuarioId'];
    $id = $_POST['Id_produto'];
    $quantidade = $_POST['quantidade'];
    $consulta = "UPDATE carrinho SET Quantidade = $quantidade WHERE Id_produto = '$id' and Id_cadastro = '$usuarioId'";
    $resultado = $conexao->query($consulta);
};

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu carrinho</title>
    <link rel="stylesheet" href="Carrinho.css">
</head>
<header>
    <span>Carrinho de compras do <?=$_SESSION['usuario']?></span>
</header>
<body>
    <h1>Seu Carrinho</h1>
    <table>
            </tbody>
            <tr>
                <td>Imagem</td>
                <td>Nome</td>
                <td>Preço</td>
            </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th>Valor total: </th>
                </tr>
                <tfooter>
        </table>
        <br>
    <?php
    $add = $conexao->prepare("SELECT * FROM carrinho WHERE Estado = 'Adicionado'");
    $add->execute();
    $result = $add->get_result();
    $finish = $conexao->prepare("SELECT * FROM carrinho WHERE Estado = 'Finalizado'");
    $finish->execute();
    $finalizado = $finish->get_result();
    $quantidade_carrinho = 0;
    $valor_total = 0;
    ?>
    <?php foreach ($result as $lista) : ?>

        <tr>
            <td><img src="../Produtos/img/<?= $lista['Id_produto'] ?>.JPG" width="50px"></td>
            <td><?= $lista['Nome_produto'] ?></td>
            <td>R$ <?= $lista['Preco'] ?></td>
            <form action="" method="POST">
                <input type="hidden" name="Id_produto" value="<?= $lista['Id_produto']; ?>">
                <input type="number" name="quantidade" min="1" value="<?= $lista['Quantidade']; ?>">
                <input type="submit" name="atualizar" value="Atualizar" class="btn">
            </form>
            <td><a href="?delete=<?= $lista['id']; ?>"><img src="../Imagens/Lixeira.png" width="50px" alt=""></a></td>
        </tr>
        <tr>
            <?php
            $valor_total += $lista['Preco'] * $lista['Quantidade'];
            $quantidade_carrinho += 1;

            ?>
        </tr>
    <?php endforeach; ?>
    <p> R$ <?= $valor_total ?>,00</p>
    <a href="?finalizar=<?= $_SESSION['usuarioId'] ?>">Finalizar Compra</a>

    <br>
    <h1>Compras Finalizadas</h1>
    <?php foreach ($finalizado as $lista) : ?>

        <table>
            <thead>
                <tr>
                    <th>Data: </th>
                </tr>
            </thead>
            </tbody>
            <tr>
                <td>Imagem</td>
                <td>Nome</td>
                <td>Preço</td>
            </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th>Valor total: </th>
                </tr>
                <tfooter>
        </table>
        <br>


    <?php endforeach; ?>

</body>

</html>