<?php
require_once "./geradorQrcode.php"; // Inclui o gerador de QR Code

// Recebe os dados enviados via POST em formato JSON
$data = json_decode(file_get_contents("php://input"), true);
$idIngresso = isset($data['ingressoId']) ? $data['ingressoId'] : null;
$cpf = isset($data['cpf']) ? $data['cpf'] : null;

if ($idIngresso !== null && $cpf !== null) {
    $string =  $idIngresso . $cpf;
    $secretKey = "fabricad";
    $criptografado = hash_hmac("sha256", $string, $secretKey);
    // Faz a consulta no banco de dados ou lógica interna para validar o ingresso
    $resultQuery = Query($criptografado); // Sua função de consulta ao banco, simulada aqui

    if ($resultQuery) {
        $testinho = $resultQuery['qrcodeid'];

        // Gera o QR Code
        ob_start();
        QRcode::png($testinho, null, QR_ECLEVEL_L, 10);
        $imageString = base64_encode(ob_get_contents());
        ob_end_clean();

        // Retorna o QR Code em formato base64 como JSON
        echo json_encode([
            'success' => true,
            'qrCodeImage' => $imageString
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'QR Code não encontrado.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Dados inválidos.'
    ]);
}
