<?php 
session_start();
$getEmail = $_GET['email'] ?? null;
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altera de Senha</title>
    <link rel="stylesheet" href="./public/css/recuperasenha.css">
</head>
<body>
    <div class="container">
        <h2>Alteração de Senha</h2>
        <p>Por favor, insira a nova senha.</p>
            <input type="text" id="novaSenha" name="novaSenha" maxlength="14" placeholder="Digite sua nova senha" required>
            <input type="text" id="confirmaSenha" name="confirmaSenha" placeholder="Insira novamente" required>
            <button type="submit" id="botao" onclick="validar('<?php echo $getEmail ?>')">Clica ai po</button>
        <p id="mensagemErro" class="mensagem-erro"></p>
    </div>

    <script src="./public/js/alterasenha.js" defer></script>
</body>
</html>
