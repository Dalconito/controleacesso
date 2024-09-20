<?php
require_once "./altSenhacontroller.php";

session_start();
$dataPost = json_decode(file_get_contents("php://input"), true);
$login = $_SESSION['login'];
header('Content-Type: application/json');

if (empty($dataPost)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Sem dados para enviar'
    ]);
}
else {
    $novaSenha = $dataPost['novaSenha'];
    updatePassword($login, $novaSenha);  // A função já envia uma resposta JSON
    exit();  // Certifique-se de que o script termina aqui
}

