<?php
require_once __DIR__ . "/verificaAPI.php";
require_once __DIR__ . "/../database/database.php";
include_once __DIR__."/../phpqrcode-master/qrlib.php";
$dataPost = json_decode(file_get_contents("php://input"), true);

header('Content-Type: application/json');

if (empty($dataPost)){
    echo json_encode([
        'status' => false,
        'message' => "Erro ao receber dados"
    ]);
}
else{
    $cpfPost = $dataPost['cpfPost'];
    $ingressoPost = $dataPost['ingressoPost'];
    $secretKey = "fabricad";
    
    $string =  $ingressoPost . $cpfPost;
    $criptografado = hash_hmac("sha256", $string, $secretKey);
    if($criptografado != null) {
        $selecaoQr = select($criptografado);
        if($selecaoQr){
            $selecaoQrId = $selecaoQr['qrcodeid'];
            ob_start();
            QRcode::png($selecaoQrId, null, QR_ECLEVEL_L, 10);
            $imageString = base64_encode(ob_get_contents());
            ob_end_clean();
    
            // Retorna o QR Code em formato base64 como JSON
            echo json_encode([
                'status' => true,
                'qrcode' => true,
                'qrCodeImage' => $imageString
            ]);
            exit();
        }
        else{
        verificarIntegridade($cpfPost, $criptografado, $ingressoPost);
        }
    }
    
    echo json_encode([
        'status' => true,
        'message' => 'Sucesso, dados em json',
        'cpf' => $cpfPost,
        'ingresso' => $ingressoPost
    ]);
    exit();
}