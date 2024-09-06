<?php
include_once "./phpqrcode-master/qrlib.php";

function connectDb()
{
    $server = "192.168.3.35"; $user = "dalconito"; $pass = "HelloWorld"; $database = "fabrica";
    $conn = mysqli_connect($server, $user, $pass, $database);
    return $conn;}

function Query($idQrCode)
{$conn = connectDb();
    $selectQuery = "SELECT * FROM qrcode where id = $idQrCode";
    $resultQuery = mysqli_query($conn, $selectQuery);
    $returnQuery = mysqli_fetch_assoc($resultQuery);
    $conn->close(); return $returnQuery;}

function gerarQrCode($texto)
{QRcode::png($texto, 'qrcode.jpeg', QR_ECLEVEL_L, 10);
    return QRcode::png($texto);}

function teste()
{echo "FUNCIONOU";}