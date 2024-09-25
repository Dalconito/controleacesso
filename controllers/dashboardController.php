<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require (__DIR__ . "/../database/database.php");

// Verifica se é uma requisição POST
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataPost = json_decode(file_get_contents("php://input"), true);
    $login = $_SESSION['login'] ?? null;
    header('Content-Type: application/json');
    $getDashboard = selectUserDash($login);
    if (empty($dataPost)) {
        // Retorna um JSON de erro
        echo json_encode([
            'status' => 'error',
            'message' => 'Nenhum dado foi enviado'
        ]);
        
    } else {
        if(isset($getDashboard['loginusr'])){

            // Retorna um JSON de sucesso
            echo json_encode([
                'status' => 'DEU CERTO',
                'message' => $getDashboard['loginusr']
            ]);
            exit;
        }else{
            echo json_encode([
                'status' => 'DEU CERTO',
                'message' => 'USUARIO NAO ENCONTRADO'
            ]);
            exit;
        }
    }
}
*/