<?php


$boolStatus = true;
$boolcpf = false;
$boolQrCode = false;

$resMatch = match (true) {
    !$boolQrCode && !$boolStatus && !$boolcpf => "Verifique os dados e tente novamente",
    !$boolQrCode && !$boolStatus => "QrCode e Status com Erro",
    !$boolQrCode && !$boolcpf => "QrCode e Cpf com Erro",
    !$boolStatus && !$boolcpf => "Status e Cpf com Problema",
    !$boolQrCode => "QrCode com Erro",
    !$boolStatus => "Status com Erro",
    !$boolcpf => "Cpf com Erro",
    default => "Todos os dados estão corretos",
};

echo $resMatch;



/*require_once (__DIR__. "/CEQr.php");
require_once (__DIR__. "/../database/database.php" );

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
    $dataApi = json_decode($response, true);
    $data = $dataApi['data'];
    foreach ($data as $varredura){
        $qtde = $varredura['produtos'][0]['qtd'];
        $idProduto = $varredura['id'];
        $status = $varredura['status']['id'];
        print_r($status . "<br>");
    }

   /* function verificarIntegridade($cpfUser, $qrCodeId, $idIngresso){
        $dataApi = getApi();
        $data = $dataApi['data'];
        $boolcpf = false;
        $boolStatus = false;
        $boolQrCode = false;
        foreach ($data as $varredura){
            if ($varredura['cliente']['doc1'] == $cpfUser){
                $boolcpf = true;
                if($varredura['status']['id'] != 9)
                    {$boolStatus = false;}
                else{
                        $select = select($qrCodeId);
                        if($select)
                        {$boolQrCode=false;}
                        else{
                            $qtde = (int)$varredura['produtos']['qtd'];
                            echo "Adicionando qrCode, Verificar pelo ID";
                            createQrCode($qrCodeId, $idIngresso, $cpfUser, $qtde);
                            $boolcpf = true;
                            $boolStatus = true;
                            $boolQrCode = true;
                        }
                }
                
            }
        }
    }
        */