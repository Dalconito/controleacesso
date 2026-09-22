<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de QrCode</title>
    <link rel="stylesheet" href="./public/css/adicionarQr.css">
</head>

<body>
    <?php require "./templates/menu.php"; ?>
    <div class="pagina">
        <form method="post" id="formQr">
            <label for="nomeC">Nome Completo</label>
            <input type="text" name="nomeC" id="nomeC" required>

            <label for="cpf">Cpf</label>
            <input type="text" name="cpf" id="cpf" maxlength="14" required>

            <label for="idIngresso">Id do Ingresso</label>
            <input type="number" name="idIngresso" id="idIngresso" required>

            <label for="idEvento">Id do Evento</label>
            <input type="text" name="idEvento" id="idEvento" required>

            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" min="1" required>

            <input type="submit" value="Adicionar">

            <div id="msgUsr"></div>
        </form>
    </div>
    <script src="./public/js/adicionarQr.js" defer></script>
</body>

</html>