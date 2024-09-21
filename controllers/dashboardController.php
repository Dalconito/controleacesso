<?php
require_once "./../database/database.php";
$dataPost = json_decode(file_get_contents("php://input"), true);
$dataLord = $dataPost['novaSenha'];
$login = $_SESSION['login'];
$opra = selectUserDash($login);

if (empty($dataPost)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Nenhum dado foi enviado'
    ]);
    exit;
}
else{
}
