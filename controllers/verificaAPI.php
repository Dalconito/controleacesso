<?php
require_once (__DIR__. "/CEQr.php");
require_once (__DIR__. "/../database/database.php" );


function enviarResp($status, $message){
    header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON
    $response = ["status" => $status, "message" => $message];
    echo json_encode($response);
    exit();
}

function getApi()
{
    $urlApi = "https://sistema.sistemawbuy.com.br/api/v1/order/";

    $data = ["usuario_api" => "56820486-3352-456f-840d-b1c4c90be465",
    "senha_api" => "8373522a87f14cd9b6d02b7db58cd356"];

    $ch = curl_init($urlApi);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
    $headers = ['Authorization: Bearer NTY4MjA0ODYtMzM1Mi00NTZmLTg0MGQtYjFjNGM5MGJlNDY1OjgzNzM1MjJhODdmMTRjZDliNmQwMmI3ZGI1OGNkMzU2',
    'Content-Type: application/json',
    'usuario_api: 56820486-3352-456f-840d-b1c4c90be465',
    'senha_api: 8373522a87f14cd9b6d02b7db58cd356'];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    return $dataApi = json_decode($response, true);
}

function verificarIntegridade($cpfUser, $qrCodeId, $idIngresso){
    $dataApi = getApi();
    $data = $dataApi['data']; $boolcpf = false;
    $boolStatus = false; $boolQrCode = false;
    $qrExistente = false; $adcQr = false;
    $pedidoStatus = false;
    foreach ($data as $varredura){
        if ($varredura['cliente']['doc1'] == $cpfUser){
            $boolcpf = true;
            if($varredura['status']['id'] != 9)
                {$boolStatus = false;}
            else{
                    $select = select($qrCodeId);
                    if($select)
                    {$qrExistente = false;}
                    else{
                        if($idIngresso == $varredura['id']){
                            $qtde = (int)$varredura['produtos'][0]['qtd'];
                            $idEvento = $varredura['produtos'][0]['produto_id'];
                            
                            createQrCode($qrCodeId, $idIngresso, $cpfUser, $qtde, $idEvento);
                            $boolcpf = true; $boolStatus = true; $boolQrCode = true; 
                            $qrExistente = true; $adcQr = true;
                        }
                        else $pedidoStatus = true;
                    }
            }
            
        }
    }
    if (!$boolQrCode && !$boolStatus && !$boolcpf) {
        $resMatch = "Verifique os dados e tente novamente";
    } elseif (!$boolQrCode && !$boolStatus) {
        $resMatch = "Id e Status com Erro";
    } elseif (!$boolQrCode && !$boolcpf) {
        $resMatch = "Id e Cpf com Erro";
    } elseif (!$boolStatus && !$boolcpf) {
        $resMatch = "Status e Cpf com Problema";
    } elseif (!$boolQrCode) {
        $resMatch = "Id com Erro";
    } elseif ($adcQr) {
        $resMatch = "Adicionando QrCode";
    } elseif (!$boolStatus) {
        $resMatch = "Status com Erro";
    } elseif (!$boolcpf) {
        $resMatch = "Cpf com Erro";
    } elseif (!$qrExistente) {
        $resMatch = "QrCode Existente";
    } elseif (!$pedidoStatus) {
        $resMatch = "TUDO ERRADO";
    }
    
    //echo $resMatch;
    
    //enviarResp("400", $resMatch);
    
}

function selectPorCpf($cpf){
    $dataApi = getApi();
    $data = $dataApi['data'];
    $dataAppend = [];
    foreach($data as $varredura){
        if($varredura['cliente']['doc1'] == $cpf)
        {
            $dataAppend[] = [
                'cpf' => $varredura['cliente']['doc1'],
                'nome' => $varredura['cliente']['nome'],
                'status' => $varredura['status']['id'],
                'qtde' => $varredura['produtos'][0]['qtd'],
                'ingresso' => $varredura['id']
            ];
        }
    }
    if(empty($dataAppend)){
        echo "nenhum dado a ser mostrado";
    }
    else{return $dataAppend;}
}