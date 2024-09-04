<?php include_once "./phpqrcode-master/qrlib.php" ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php // Dados para o QR Code
    $text = 'ESTE TEXTO VAI PARA UM CODIGO QR';

// Gera o QR Code
QRcode::png($text, 'qrcode.jpeg', QR_ECLEVEL_L, 10);

// Exibe o QR Code no navegador
header('Content-Type: image/png');
QRcode::png($text);
?>
</body>
</html>
