<?php
require_once('../Mysql.php');

$conexao = Mysql::conexao();
if ($conexao->connect_error) {
    die("A conexão falhou: " . $conexao->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["Nome_cliente"];
    $sobrenome = $_POST["Sobrenome"];
    $email = $_POST["Email"];
    $senha = password_hash($_POST["Senha"], PASSWORD_DEFAULT);
    $nascimento = $_POST["Nascimento"];
    $cpf = $_POST["CPF"];
    $genero = $_POST["Genero"];
    $cidade = $_POST["Cidade"];
    $estado = $_POST["Estado"];

    $sql_cadastro = "INSERT INTO clientes (Nome_cliente, Sobrenome, Email, Senha, Nascimento, CPF, Genero, Cidade, Estado) VALUES('$nome', '$sobrenome', '$email', '$senha', '$nascimento' ,'$cpf', '$genero' ,'$cidade', '$estado')";
    $conexao->query($sql_cadastro);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        header("Location: login.php");
        exit();
    }

    $conexao->close();

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>


<body>
    <form action="" method="post">
        <h1>
            <b>Faça seu cadastro!</b>
        </h1>

        <form action="Cadastro concluído" class="">
            <div class="form-group">
                <label for="uname">Digite seu nome:</label>
                <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" name="Nome_cliente"
                    required>
            </div>

            <div class="form-group">
                <label for="uname">Digite seu sobrenome:</label>
                <input type="text" class="form-control" id="sobrenome" placeholder="Digite seu sobrenome"
                    name="Sobrenome" required>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="uname">Digite seu e-mail:</label>
                    <input type="text" class="form-control" id="email" placeholder="Digite seu email" name="Email"
                        required>

                </div>
            </div>

            <div class="form-group">
                <label for="pwd">Digite sua senha:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Digite sua senha" name="Senha" minlength="6"
                    required>
            </div>

            <div class="form-group">
                <label for="pwd">Confirme sua senha:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Confirme sua senha"
                    name="confirmar_senha" required>
            </div>

            <div class="form-group">
                <label for="iidade">Digite sua data de nascimento:</label>
                <input class="form-control" type="date" name="Nascimento" id="inascimento" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input class="form-control" type="number" id="cpf" name="CPF" autocomplete="off" minlength="11" maxlength="11" required>
            </div>

            <div class="form-group">
                <label for="Estado">Genero:</label>
                <select class="form-control" id="genero" name="Genero" required>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="X">Prefiro não responder</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input class="form-control" type="text" id="cidade" name="Cidade" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" id="estado" name="Estado" required>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal </option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goías</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>
            <div>
                <input type="checkbox" name="Termo" id="" required>Eu aceito os <a href="">Termos e Política
                    Privacidade</a>
                desse site.
            </div>
            <p>Ja possui um cadastro? Faça o <a href="login.php">Log-in.</a></p>
            <a href="login.php"><button type="submit" class="">Concluir cadastro</button></a>

        </form>

        <script>
            //cpf
            document.getElementById("cpf").addEventListener("input", function () {
                let cpfInput = this.value;

                if (cpfInput.length = 11) {
                    cpfInput = cpfInput.slice(0, 11); // Limita a 11 dígitos
                }

                this.value = cpfInput;
            });

            //senha
            $(document).ready(function () {
                $('#confirmar_senha').on('input', function () {
                    if ($(this).val() !== $('#senha').val()) {
                        $('#senhaError').text('As senhas não coincidem.');
                    } else {
                        $('#senhaError').text('');
                    }
                });

                $('#cadastroForm').submit(function (event) {
                    if ($('#senha').val() !== $('#confirmar_senha').val()) {
                        $('#senhaError').text('As senhas não coincidem.');
                        event.preventDefault();
                    }
                });
            });

        </script>
        </div>
        </div>
    </form>
</body>


</html>