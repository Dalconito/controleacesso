<?php
session_start();
$login = $_SESSION['login'];
$opra = selectUserDash($login);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Olá <?php echo htmlspecialchars($_SESSION['login']); ?></h1>

    <button id="botaoEnvia">Enviar Dados</button>

    <script src="./public/js/dashboard.js" defer></script>
</body>
</html>
