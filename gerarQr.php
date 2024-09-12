<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/gerarQr.css">
</head>
<body>
    <form method="post">
        <label for="idQrCode">Informe o ID</label>
        <input type="number" id="idQrCode" name="idQrCode">

        <button type="Mostrar QrCode"></button>
    </form>    

<?php
    require_once "./qrcode/geradorQrcode.php";
    $idQrCode = isset($_POST['idQrCode']) ? $_POST['idQrCode'] : null;
    $resultQuery = isset($_POST['idQrCode'])  ? Query($idQrCode) : null;

    if($resultQuery != null)
    {
        $testinho = $resultQuery['qrcodeid'];
        echo $resultQuery['qrcodeid'];
        ob_start();
        QRcode::png($testinho, null, QR_ECLEVEL_L, 10);
        $imageString = base64_encode(ob_get_contents());
        ob_end_clean();
    }

?>
<div>
    <img src="data:image/png;base64,<?= $imageString ?>" alt="QR Code">
</div>
<script src="./public/js/gerarQr.js"></script>
</body>
</html>