<?php
include_once "./phpqrcode-master/qrlib.php";
require_once (__DIR__."/../database/database.php");

function Query($idQrCode)
{$conn = connectDb();
    $selectQuery = "SELECT * FROM qrcode where id = $idQrCode";
    $resultQuery = mysqli_query($conn, $selectQuery);
    $returnQuery = mysqli_fetch_assoc($resultQuery);
    $conn->close(); return $returnQuery;}
