<?php

require_once(__DIR__."/../database/database.php");
$postData = isset($_POST['qrCode']) ? $_POST['qrCode'] : null;
$response = [];

    $conn = connectDb();
    $selectDbQuery = "SELECT * FROM qrcode WHERE qrcodeid=? ";
    $query = $conn->prepare($selectDbQuery);
    if($query === false){printError();}
    $query->bind_param("s", $postData);
    if($query->execute()){
        $resultDbQuery = $query->get_result();
        $resultQuery = $resultDbQuery->fetch_assoc();
        printSucesso("Selecao feita");
    }
    else {printErroExecute("Seleção");}
    $query->close(); $conn->close();

    if ($resultQuery['stat'] == 0)
    {updateQrCode($postData);}
    else enviarResposta("001", "QrCode Já validado");

function updateQrCode($postData){
    $conn = connectDb();
    $updateDbQuery = " UPDATE qrcode set stat=? where qrcodeid=?;";
    $query = $conn->prepare($updateDbQuery);
    if($query === false){printError();}
    $um = '1';
    $query->bind_param("ss", $um, $postData);
    if($query->execute()){printInseriu();} 
    else {printErroExecute($query->error);}
    $query->close(); $conn->close();
    enviarResposta("002", "ALTERADO");
}

function printSucesso($msg){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\n$msg com sucesso - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}
function printSucessoDb(){
    $alterFile = "consoleDb.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nBanco de dados conectado com sucesso - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printTest(){
    $alterFile = "teste.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nAté aqui certo - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printError(){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nErro ao preparar a Query - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printInseriu(){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nSucesso ao executar a operacao de bind_param - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printErroExecute($execute){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nErro ao executar a $execute - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function enviarResposta($status, $message){
    header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

    // Simulação de dados que você quer enviar de volta para o frontend
    $response = ["status" => $status, "message" => $message];

    // Converta o array para JSON e envie a resposta
    echo json_encode($response);}