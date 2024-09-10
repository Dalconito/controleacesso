<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de QrCode</title>
</head>
<body>
    <h1>Cadastro de QrCode</h1>
    <form method="post">
        <label for="nomeC">Nome Completo</label>
        <input type="text" name="nomeC" id="nomeC">

        <label for="nomeC">Cpf</label>
        <input type="text" name="cpf" id="cpf">

        <label for="nomeC">Id do Ingresso</label>
        <input type="text" name="idIngresso" id="idIngresso">

        <input type="submit" value="Adicionar">
    </form>
</body>

<?php
include_once "./controllers/CEQr.php";
    $postData = isset($_POST) ? $_POST:null;
    $string = $postData['nomeC'] . $postData['cpf'] . $postData['idIngresso'];
    echo $string . "\n";
    $secretKey = "fabricad";

    $criptografado = hash_hmac("sha256", $string, $secretKey);
    echo $criptografado;
    
   if($criptografado != null)
   {
        createQrCode($criptografado);
   }
?>  
</html>