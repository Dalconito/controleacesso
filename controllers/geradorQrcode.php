<?php
include_once __DIR__."/../phpqrcode-master/qrlib.php";
require_once (__DIR__."/../database/database.php");

function Query($idQrCode)
{$conn = connectDb();
    $selectQuery = "SELECT qrcodeid FROM qrcode where qrcodeid = '$idQrCode'";
    $resultQuery = mysqli_query($conn, $selectQuery);
    $returnQuery = mysqli_fetch_assoc($resultQuery);
    $conn->close(); return $returnQuery;}
