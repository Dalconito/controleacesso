<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome']) && isset($_POST['email'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        // Processa os dados normalmente
        $response = [
            'status' => 'success',
            'message' => 'Dados recebidos com sucesso',
            'nome' => $nome,
            'email' => $email
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
}
?>
