<?php
require_once (__DIR__. "/CEQr.php");
require_once (__DIR__. "/../database/database.php" );

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
                            echo "Adicionando qrCode, Verificar pelo ID";
                            createQrCode($qrCodeId, $idIngresso);
                            $boolcpf = true;
                            $boolStatus = true;
                            $boolQrCode = true;
                        }
                }
                
            }
        }
    }