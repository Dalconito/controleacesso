<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    echo $resultQuery['qrcode'];
?>
</body>
</html>