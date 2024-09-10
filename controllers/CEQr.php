<?php
require_once (__DIR__ . "/../database/database.php");

function createQrCode($qrCodeId, $idIngresso){
    $conn = connectDB();
    $createDbQuery = "INSERT INTO qrcode (qrcodeid, stat, evento_id) VALUES (?,?,?);";
    $query = $conn->prepare($createDbQuery);
    if($query === false){echo "deu ruim";}
    $stat = '0';
    $query->bind_param("ssi", $qrCodeId, $stat, $idIngresso);
    if($query->execute()){echo "deu bom";}
    else{echo($query->error);}
    $query->close(); $conn->close();
    
}