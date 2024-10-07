<?php

$dataPost = json_decode(file_get_contents("php://input"), true);

header('Content-Type: application/json');

if (empty($dataPost)){
    echo json_encode([
        'status' => false,
        'message' => "Erro ao receber dados"
    ]);
}
else{
    $cpfPost = $dataPost['cpf'];
    $ingressoPost = $dataPost['ingresso'];

    echo json_encode([
        'status' => true,
        'message' => 'Sucesso, dados em json',
        'cpf' => $cpfPost,
        'ingresso' => $ingressoPost
    ]);
    exit();
}