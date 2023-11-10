<?php

require_once('../Mysql.php');
session_start();

$conexao = Mysql::conexao();
if ($conexao->connect_error) {
    die("A conexão falhou: " . $conexao->connect_error);
}

if(isset($_GET['finalizar'])){
    $id = $_GET['finalizar'];
    $consulta = "UPDATE carrinho SET Estado = 'Finalizado' WHERE Id_cadastro = $id";
    $resultado = $conexao->query($consulta);
    header("Location: ../Produtos/Produtos.php");
};

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="stylesheet" href="pagamento.css">
</head>
<body>
    <header>
        <nav>
            <h1 class="nomeLoja">Obrigado por comprar na Street Store!</h1>
        </nav>
    </header>

    <main>
        <section>
            <h2 class="pag">Frete e pagamento</h2>
            <div class="entrega">
                <p>Selecione o tipo de entrega</p>
                <p>Vendido e entregue por Street Store</p>
                
            </div>
            <div class="PagamentoPix">
                <img src="img/qrcode.jfif" alt="Qrcode" width="150px" height="150px">
                <p>Pix copia e cola: <button id="copiarBotao">Copiar Texto</button>
                    <p id="textoParaCopiar">00020126470014br.gov.bcb.pix0117teste@gmail.com@gmail.com5204000053039865802BR5919TestePix6008Brasilia62080504mpda6304CDEC</p>
                
                    <script>
                        const copiarBotao = document.getElementById('copiarBotao');
                        const textoParaCopiar = document.getElementById('textoParaCopiar');
                
                        copiarBotao.addEventListener('click', () => {
                            const texto = textoParaCopiar.innerText;
                            const tempInput = document.createElement('input');
                            document.body.appendChild(tempInput);
                            tempInput.value = texto;
                            tempInput.select();
                            document.execCommand('copy');
                            document.body.removeChild(tempInput);
                            alert('Texto copiado para a área de transferência: ' + texto);
                        });
                    </script> </p>
                <p>
                    1 - Após a finalização do pedido, abra o app ou banco de sua preferência. Escolha a opção pagar com código Pix “copia e cola”, ou código QR.
                </p>

                <p>
                    2 - Copie e cole o código, ou escaneie o código Qr com a câmera do seu celular.
                    Confira todas as informações e autorize o pagamento.
                </p>


            </div>
            <div class="PagamentoCartao">
                <h2>Pagar com cartão de crédito</h2>
                <label for="numeroCartao">Número do Cartão:</label>
                <input type="text" id="numeroCartao" name="numeroCartao" placeholder="**** **** **** ****" minlength="16" maxlength="16">

                <br>
                
                <label for="mesValidade">Mês de Validade:</label>
                <input type="text" id="mesValidade" name="mesValidade" placeholder="Mês" minlength="2" maxlength="2">
                 
                <br>

                <label for="anoValidade">Ano de Validade:</label>
                <input type="text" id="anoValidade" name="anoValidade" placeholder="Ano" minlength="2" maxlength="2">
                
                <br>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="***" minlength="3" maxlength="3">
            </div>
        
            <button class="btn-pagamento"><a href="?finalizar=<?= $_SESSION['usuarioId'] ?>"><font color=white>Finalizar Compra<font></button>
        </section>
    
    </main>

    <footer>
      
    </footer>
</body>
</html>

