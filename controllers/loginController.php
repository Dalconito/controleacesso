<?php
require_once (__DIR__. "/../database/database.php");

$loginUser = isset($_POST['login']) ? $_POST['login'] : null;
$senhaUser = isset($_POST['senha']) ? $_POST['senha'] : null;
$result = selectUser($loginUser);

if($loginUser and $result !=null){
    if($loginUser == $result['loginusr']){
        if($senhaUser == $result['senha']){
            if($result['tipo_conta'] == 1){
                $_SESSION['tipoUsr'] = 'admin';
                header("location: ./adicionarQr.php");
            }
            else{
                $_SESSION['tipoUsr'] = 'comum';
                header("location: ./adicionarQr.php");
            }
        }
        else{enviarResposta("020","Senha incorreta");}
    }
    else{echo "LOGIN NAO ENCONTRADO";}
}

function enviarResposta($status, $message){
    header('Content-Type: application/json');
    $response = array("status" => $status,"message" => $message);
    echo json_encode($response);
}