<?php
require_once (__DIR__ . "/../database/database.php");

session_start(); // Inicie a sessão

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

$response = ["status" => "error", "message" => "Algo deu errado."];

$loginUser = isset($_POST['login']) ? $_POST['login'] : null;
$senhaUser = isset($_POST['senha']) ? $_POST['senha'] : null;

if ($loginUser && $senhaUser) {
    $result = selectUser($loginUser);

    if ($result) {
        if ($loginUser == $result['loginusr']) {
            if ($senhaUser == $result['senha']) {
                $_SESSION['tipoUsr'] = ($result['tipo_conta'] == 2) ? 'admin' : 'comum';
                $response = ["status" => "success", "message" => "Login bem-sucedido."];
            } else {
                $response = ["status" => "020", "message" => "Senha incorreta"];
            }
        } else {
            $response = ["status" => "021", "message" => "Login não encontrado"];
        }
    } else {
        $response = ["status" => "022", "message" => "Usuário não encontrado"];
    }
}

echo json_encode($response);
exit();
