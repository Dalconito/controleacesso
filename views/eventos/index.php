<?php
session_start();

?>
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
            <label for="nomeEvento">Nome Evento</label>
            <input type="text" name="nomeEvento" id="nomeEvento" required>

            <label for="Responsavel">Responsável</label>
            <input type="text" name="Responsavel" id="Responsavel" maxlength="40" required>

           <label for="dataInicio">Data De Inicio</label>
            <input type="datetime-local" name="dataInicio" id="dataInicio" maxlength="14" required>

            <label for="dataTermino">Data de Termino</label>
            <input type="datetime-local" name="dataTermino" id="dataTermino" maxlength="14" required>

            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" required>

            <input type="submit" value="Adicionar">

            <div id="msgUsr"></div>
        </form>

    </div>
    <script src="./public/js/adicionarEvento.js" defer></script>
</body>

</html>