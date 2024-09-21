<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- Exibe o nome do usuário logado -->
    <h1>Olá <?php echo htmlspecialchars($_SESSION['login']); ?></h1>

    <!-- Botão para enviar dados via JavaScript -->
    <button id="botaoEnvia">Enviar Dados</button>

    <!-- Inclui o script que contém o JavaScript para a interação com o servidor -->
    <script src="./public/js/dashboard.js" defer></script>
</body>
</html>
