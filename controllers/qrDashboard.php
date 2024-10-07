<?php
require_once(__DIR__ . "/verificaAPI.php");
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
    if($criptografado != null) {verificarIntegridade($cpfPost, $criptografado, $ingressoPost);}
    
    echo json_encode([
        'status' => true,
        'message' => 'Sucesso, dados em json',
        'cpf' => $cpfPost,
        'ingresso' => $ingressoPost
    ]);
    exit();
}