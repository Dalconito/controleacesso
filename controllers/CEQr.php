<?php
require_once (__DIR__ . "/../database/database.php");
require_once __DIR__ . "/print.php";

function createQrCode($qrCodeId, $idIngresso){
    $conn = connectDB();
    $createDbQuery = "INSERT INTO qrcode (qrcodeid, stat, evento_id) VALUES (?,?,?);";
    $query = $conn->prepare($createDbQuery);
    if($query === false){printErroExecute("a preparacao da query na funcao createQrCode no arquivo: " . __FILE__);}
    $stat = '0';
    $query->bind_param("ssi", $qrCodeId, $stat, $idIngresso);
    if($query->execute()){echo "QrCode criado com sucesso";}
    else{echo($query->error);}
    $query->close(); $conn->close();
    
}