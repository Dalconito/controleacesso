<?php
require_once (__DIR__. "/../database/database.php");

$loginUser = isset($_POST['login']) ? $_POST['login'] : null;
$senhaUser = isset($_POST['senha']) ? $_POST['senha'] : null;
if($loginUser !=null){
    $result = selectUser($loginUser);
    if($loginUser == $result['loginusr']){
        if($senhaUser == $result['senha'])
        {
            if($result['tipo_conta'] == 1)
            $_SESSION['tipoUsr'] = 'admin';
            else
            $_SESSION['tipoUsr'] = 'comum';
        header("location: ./adicionarQr.php");
        }
        else{echo "SENHA INCORRETA";}
    }
    else{echo "LOGIN NAO ENCONTRADO";}
}