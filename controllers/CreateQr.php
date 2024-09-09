<?php
require_once (__DIR__ . "/../database/database.php");

function createQrCode($qrCodeId){
    $conn = connectDB();
    $createDbQuery = "INSERT INTO qrcode (qrcodeid, stat) VALUES (?,?);";
    $query = $conn->prepare($createDbQuery);
    if($query === false){echo "deu ruim";}
    $stat = '0';
    $query->bind_param("ss", $qrCodeId, $stat);
    if($query->execute()){echo "deu bom";}
    else{echo($query->error);}
    $query->close(); $conn->close();
    
}