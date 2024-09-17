<?php
require_once (__DIR__ . "/../database/database.php");
require_once __DIR__ . "/print.php";

function createQrCode($qrCodeId, $idIngresso, $cpfUser, $qtde, $eventoId){
    $conn = connectDB();
    $createDbQuery = "INSERT INTO qrcode (qrcodeid, stat, id_ingresso, cpf, qtde, evento_id) VALUES (?,?,?,?,?,?);";
    $query = $conn->prepare($createDbQuery);
    if($query === false){printErroExecute("a preparacao da query na funcao createQrCode no arquivo: " . __FILE__);}
    $stat = '0';
    $query->bind_param("ssssis",$qrCodeId, $stat, $idIngresso, $cpfUser, $qtde, $eventoId);
    if($query->execute()){printSucesso("Qr Adicionado com sucesso");}
    else{echo $query->error;}
    $query->close(); $conn->close();
    
}