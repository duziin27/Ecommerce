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

$consulta = "SELECT Id_produto, Nome_produto, Preco, Quantidade_estoque FROM produtos";
$resultado = $conexao->query($consulta);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Produtos.css">

    <title>Street Store</title>
</head>

<body>

    <nav>
        <div class="nav_logout">
            <a href="../Cadastro E Login/logout.php">Log-out</a>|
            <p> Olá,
                <?php echo $_SESSION['usuario']; ?>!
            </p>
        </div>
        <div class="nav_logo">
            <h1>Street Store</h1>
        </div>
        <div class="nav_market">
            <a class="btheader" href="../Carrinho/Carrinho.php">
                <img src="../Imagens/Carrinho.png" alt="" width="40px">
            </a>
        </div>
    </nav>

    <section class="subnavbar">
        <ul>
            <li><a href="../Cadastro E Login/cadastro.php">Cadastro</a></li>
            <li><a href="#">Produtos</a></li>
            <li><a href="#">Sobre Nós</a></li>
        </ul>
        </nav>

        <section class="produtos">
            <?php

            $select = $conexao->prepare("SELECT * FROM produtos");
            $select->execute();

            // Obter o resultado da consulta
            $result = $select->get_result();

            // Verificar se a consulta retornou resultados
            if ($result->num_rows > 0) {
                // Loop através dos resultados e exibir os produtos
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='produtos'>";
                    echo "<div class='produto'>";
                    echo "<img src='img/" . $row["Id_produto"] . ".JPG' alt='" . $row["Nome_produto"] . "'>";
                    echo "<div class='produto-detalhes'>";
                    echo "<h2>" . $row["Nome_produto"] . "</h2>";
                    echo "<h2> R$ " . $row["Preco"] . ",00 </h2>";
                    echo "<p>" . $row["Descricao"] . "</p>";
                    echo "<p>Estoque: " . $row["Quantidade_estoque"] . "</p>";
                    echo '<button class="add_cart" type="submit" value="add_cart" name=" style="margin: 0;" data-product-id="' . $row["Id_produto"] . 'data-product-name="' . $row["Nome_produto"] . 'data-product-quantity="' . $row["Quantidade_estoque"] . 'data-product-genero="' . $row["Genero"] . '" data-product-description="' . $row["Descricao"] . '" data-product-price="' . $row["Preco"] . '"><b>Adicionar ao carrinho</b> <i class="bx bxs-cart"></i> </button>';
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "Nenhum produto encontrado no banco de dados.";
            }

            // Fechar a conexão com o banco de dados
            $conexao->close();
            ?>
        </section>

        <footer>
            <p>&copy; 2023 Eduardo Corrêa Brito (MSCODE)</p>
        </footer>
</body>

</html>