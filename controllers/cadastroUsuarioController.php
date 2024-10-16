<?php
require_once(__DIR__ . "/../database/database.php");

$dataPost = json_decode(file_get_contents('php://input'), true);

if (empty($dataPost)) {
    enviarRespostaFront(false, 'Dados Vazios');
} else {
       $login = $dataPost['login'];
       $cpf = $dataPost['cpf'];
       $email = $dataPost['email'];
       $senha = $dataPost['senha'];

        $conn = connectDb();
        $selectCpf = selectperso('cpf',$cpf);
        $selectLogin = selectperso('loginusr',$login);
        $selectEmail = selectperso('email',$email);

        if($selectLogin){
            enviarRespostaFront(false, 'Login Existente');
            exit();
        }else
        if($selectCpf){
            enviarRespostaFront(false, 'Cpf Existente');
            exit();
        }else
        if($selectEmail){
            enviarRespostaFront(false, 'Email Existente');
            exit();
        }else{
            $query = "INSERT INTO usuarios (loginusr, cpf, email,tipo_conta, senha) VALUES (?,?,?,1,?);";
            $queryCreate = $conn->prepare($query);
            if($queryCreate === false){enviarRespostaFront(false, 'Erro ao cadastrar Usuario');}
            $queryCreate->bind_param('ssss', $login,$cpf,$email,$senha);
            if($queryCreate->execute()){
                enviarRespostaFront(true, 'Usuario adicionado com Sucesso!');
            }else {
                $queryCreate->close(); $conn->close();
                enviarRespostaFront(false, 'Erro ao Adicionar Usuario!');}
        }
}

function enviarRespostaFront($status, $mensagem){
    header('Content-Type: application/json');
    echo json_encode([
        'status' => $status,
        'message' => $mensagem
    ]);
    exit();
}