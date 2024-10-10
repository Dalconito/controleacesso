<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="./public/css/recuperasenha.css">
</head>
<body>
    <div class="container">
        <h2>Recuperação de Senha</h2>
        <p>Por favor, insira seu CPF e e-mail para continuar com a recuperação de senha.</p>
        <form id="recuperacaoForm">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="Digite seu CPF" oninput="formatarCPF(this)" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
            
            <button type="submit">Enviar</button>
        </form>
        <p id="mensagemErro" class="mensagem-erro"></p>
    </div>
    <script>
        
    </script>
    <script src="./public/js/recuperasenha.js" defer></script>
</body>
</html>
