<?php session_start();
    include_once "./controllers/CEQr.php";
    require_once "./controllers/verificaAPI.php";
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
    <form method="post">
        <label for="nomeC">Nome Completo</label>
        <input type="text" name="nomeC" id="nomeC" required>

        <label for="cpf">Cpf</label>
        <input type="text" name="cpf" id="cpf" oninput="mascaraCPF(this)" maxlength="14" required>

        <label for="idIngresso">Id do Ingresso</label>
        <input type="number" name="idIngresso" id="idIngresso" required>

        <input type="submit" value="Adicionar">
        <div id="errorMessage"></div>
    </form>
    </div>
    <script src="./public/js/adicionarQr.js" defer></script>
</body>

<?php
    $postData = isset($_POST) ? $_POST : null;
    $idIngresso = isset($postData['idIngresso']) ? $postData['idIngresso'] : null;
    $cpfC = isset($postData['cpf']) ? $postData['cpf'] : null;
    $secretKey = "fabricad";
    $string = isset($_POST['idIngresso']) ? $postData['nomeC'] . $postData['cpf'] . $postData['idIngresso'] : null;
    $criptografado = hash_hmac("sha256", $string, $secretKey);
    if($criptografado != null) {verificarIntegridade($cpfC, $criptografado, $idIngresso);}

?>  
</html>