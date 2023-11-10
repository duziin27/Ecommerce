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
    $finalizado = $conexao->query($consulta);
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="styles.css"/>

</head>

<body>
<nav>
 <div class="nav_logout">
            <a href="../logout.php">Log-out</a>|
            <p> Carrinho de
                <?php echo $_SESSION['usuario']; ?>
            </p>
        </div>
        <div class="nav_logo">
            <h1>Street Store</h1>
        </div>
        <div class="nav_carrinho">
            <a class="btheader" href="../Carrinho/Carrinho.php">
                <img src="../Imagens/Carrinho.png" alt="" width="40px">
            </a>
        </div>
    </nav>
    <main>
        <div class="page-title">Seu Carrinho</div>
        <div class="content">
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <td>
                                    <div class="product">
                                        <img src="../Produtos/img/<?= $lista['Id_produto'] ?>.JPG" width="5%">
                                        <div class="info">
                                            <div class="name"><?= $lista['Nome_produto'] ?></div>
                                            <div class="genero"><?= $lista['Genero'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>R$ <?= $lista['Preco'] ?></td>
                                <td>
                                    <center><span class="">1</span></center>
                                </td>
                                <td>
                                    <a href="?delete=<?= $lista['id']; ?>"><img src="../Imagens/Lixeira.png" class="remove" alt=""></a>
                                </td>
                                <?php
                                $valor_total += $lista['Preco'] * $lista['Quantidade'];
                                $quantidade_carrinho += 1;

                                ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="page-title">Minhas últimas compras</div>
                <table>
                <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Data da compra</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($finalizado as $lista) : ?>
                            <tr>
                                <td>
                                    <div class="product">
                                        <img src="../Produtos/img/<?= $lista['Id_produto'] ?>.JPG" width="5%">
                                        <div class="info">
                                            <div class="name"><?= $lista['Nome_produto'] ?></div>
                                            <div class="genero"><?= $lista['Genero'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>R$<?= $lista['Preco'] ?></td>
                                <td><?= $lista['Data_compra']?></td>
                                <td><?= $lista['Estado']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <aside>
                <div class="box">
                    <header>Resumo da compra</header>
                    <div class="info">
                        <div><span>Sub-total</span><span> R$ <?= $valor_total ?>,00</span></div>
                        <div><span>Frete</span><span>Gratuito</span></div>
                        <div>
                            <button>
                                Adicionar cupom de desconto
                            </button>
                        </div>
                    </div>
                    <footer>
                        <span>Total</span>
                        <span> R$ <?= $valor_total ?>,00</span>
                    </footer>
                </div>

                <button><a href="../pagamento/pagamento.php">
                        <font color=white>Efetuar o pagamento</font>
                    </a></button>
                <br>
                <button><font color=white><a href="../Produtos/Produtos.php">Comprar mais</a></button>

            </aside>
        </div>
    </main>
</body>

</html>