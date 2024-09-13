<?php session_start();
    include_once "./controllers/CEQr.php";
    require_once "./controllers/verificaAPI.php";
    require_once "./controllers/adicionarQrController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de QrCode</title>
    <link rel="stylesheet" href="./public/adicionarQr.css">
</head>
<body>
    <form method="post">
        <label for="nomeC">Nome Completo</label>
        <input type="text" name="nomeC" id="nomeC" required>

        <label for="nomeC">Cpf</label>
        <input type="text" name="cpf" id="cpf" required>

        <label for="nomeC">Id do Ingresso</label>
        <input type="number" name="idIngresso" id="idIngresso" required>

        <input type="submit" value="Adicionar">
        <p id="msgUsr"></p>
    </form>
    <script src="./public/js/adicionarQr.js"></script>
</body>

<?php
    $postData = isset($_POST) ? $_POST : null;
    $string = isset($_POST['idIngresso']) ? $postData['nomeC'] . $postData['cpf'] . $postData['idIngresso'] : null;
    $cpfC = isset($postData['cpf']) ? $postData['cpf'] : null;
    $idIngresso = isset($postData['idIngresso']) ? $postData['cpf'] : null;
    $secretKey = "fabricad";
    $criptografado = hash_hmac("sha256", $string, $secretKey);
    if($criptografado != null) verificarIntegridade($cpfC, $criptografado, $idIngresso);

?>  
</html>