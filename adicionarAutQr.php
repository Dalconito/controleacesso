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
</body>

<?php

    $idIngresso = $_GET['idIngresso'] ?? null;
    $cpfC = $_GET['cpf'] ?? null;
    $secretKey = "fabricad";
    if (empty($idIngresso) && empty($cpfC)) {
        echo "volte para a pagina anterior, dados nao reconhecidos";
    } else {$string =  $idIngresso . $cpfC;
        $criptografado = hash_hmac("sha256", $string, $secretKey);
        if($criptografado != null) {verificarIntegridade($cpfC, $criptografado, $idIngresso);}
    }

?>  
</html>