<?php 
require_once('../Mysql.php');

// Conexão com o banco de dados
$conexao = Mysql::conexao();
if ($conexao->connect_error) {
    die("A conexão falhou: " . $conexao->connect_error);
}

/*
$criabanco = "CREATE DATABASE ecommerce";
if($conexao->query($criabanco) === TRUE){
    echo "O banco foi criado com sucesso!";
}
*/

/*
$tabelaclientes = "CREATE TABLE Clientes(
	Id_cadastro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Nome_cliente VARCHAR(100) NOT NULL,
	Sobrenome VARCHAR(100) NOT NULL,
	Email VARCHAR(255) NOT NULL,
	Senha VARCHAR(255) NOT NULL,
 	Nascimento VARCHAR(100) NOT NULL,
	CPF VARCHAR(100) NOT NULL,
	Genero VARCHAR(100) NOT NULL,
	Cidade VARCHAR(100) NOT NULL,
	Estado VARCHAR(100) NOT NULL
 )";

 if($consulta = $conexao->query($tabelaclientes)){
    echo "A tabela foi criada!";
};
*/

/*
$tabprodutos = "CREATE TABLE Produtos(
    Id_produto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nome_produto VARCHAR(50) NOT NULL,
    Preco INT(255) NOT NULL,
    Genero VARCHAR(50) NOT NULL,
    Quantidade_estoque INT(50) NOT NULL,
    Descricao TEXT)";

if($consultasql = $conexao->query($tabprodutos)){
    echo "A tabela foi criada!";
}
*/

/*
$tabelacarrinho = "CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Id_cadastro INT NOT NULL,
    Id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    descricao TEXT NOT NULL,
    data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Id_cadastro) REFERENCES clientes(Id_cadastro),
    FOREIGN KEY (Id_produto) REFERENCES produtos(Id_produto)
)";

if($consulta = $conexao->query($tabelacarrinho)){
    echo "A tabela foi criada!";
};
*/

/*
$inserir = "INSERT INTO ecommerce.Produtos (Id_produto, Nome_produto, Preco, Genero, Quantidade_estoque, Descricao) VALUES 
(1, 'Calça Moletom Z', 89.90, 'Unisex', 12, 'Calça Moletom da Z da cor branca com tecido 100% algodão, flexivel e confortavel'),
(2, 'Camisa NAIVETE', 49.90, 'Feminino', 48, 'Camisa Casual NIVETE com designer simples de estampa ousada com material de poliéster'),
(3, 'Casaco Fantastical', 99.90, 'Unisex', 36, 'Casaco Moletom da Fantastical com tecnologia de duas camadas sendo impermeavel por fora e acochegante por dentro com tecidos 10% algodão'),
(4, 'Camisa Casual NAIVETE', 39.90, 'Feminino', 55, 'Camisa Casual NIVETE com designer simples de estampa ousada com material de poliéster'),
(5, 'Calça Moletom Preta MMUSEUM', 69.90, 'Unisex', 12, 'Calça Moletom da Z da cor branca com tecido 100% algodão, flexivel e confortavel'),
(6, 'KIT 3 Camisa Moletom ESDBOY', 138.90, 'Masculino', 21, 'Um kit com 3 camisas de moletom da ESDBOY para combinar com todos os seus tipos de looks, todas flexiveis de tecido 100% algodão'), 
(7, 'KIT 3 Camisa Longa ESDBOY', 119.98, 'Unisex', 14, 'Um kit com 3 camisetas da ESDBOY para combinar com todos os seus tipos de looks de tecido poliéster'), 
(8, 'Look Calvin Klein', 89.90, 'Masculino', 13, 'Kit camisa e short da Calvin Klein de tecidos de algodão e poliéster'), 
(9, 'Tênis Jordan NIKE', 129.90, 'Unisex', 15, 'Tênis Jordan da Nike altografada modelo unico'), 
(10, 'Camisa Longa TIMES', 39.90, 'Unisex', 18, 'Camisa Longa da TIMES com designer ousado 100% algodão')";
if($consultasql = $conexao->query($inserir)){
    echo "A inserção foi realizada!";
}

$query = "SELECT * FROM ecommerce.Produtos";
if($consultasql = $conexao->query($query)){
     
}
*/



//Verificação do login
if(isset($_POST['submit']) && !empty($_POST['Email']) && !empty($_POST['Senha'])) {
    $email = $_POST['Email'];
    $senha = $_POST['Senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";

    $result = $conexao->query($sql);

    if(mysqli_num_rows($result) < 1 ){
        header('Location:login.php');

}else{
    header('Location:../Index/index.php');
};

}

?>