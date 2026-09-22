<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataPost = json_decode(file_get_contents('php://input'), true);
    if(isset($dataPost)){

        $nomePost = $dataPost['data'];

    }
        // Processa os dados normalmente
        $response = [
            'status' => 'success',
            'message' => 'Dados recebidos com sucesso',
            'nome' => $nomePost
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        session_destroy(); session_unset();
    } else {
        // Dados incompletos
        $response = [
            'status' => 'error',
            'message' => 'Dados incompletos'
        ];

        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($response);
    }

