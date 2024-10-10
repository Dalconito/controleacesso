<?php

require_once __DIR__ . "/sendEmail.php";
require_once __DIR__ . "/../database/database.php";

header('Content-Type: application/json');

// Obtém o corpo da requisição (JSON bruto)
$jsonData = file_get_contents('php://input');

// Verifica se há erro ao ler o JSON
if ($jsonData === false || empty($jsonData)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'O corpo da requisição está vazio ou não foi possível ler php://input']);
    exit;
}

// Decodifica o JSON para um array PHP
$data = json_decode($jsonData, true);

// Verifica se o JSON foi decodificado corretamente
if ($data === null) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao decodificar JSON!', 'erro_json' => json_last_error_msg()]);
    exit;
}

// Processa os dados recebidos
$cpf = $data['cpf'] ?? '';
$email = $data['email'] ?? '';
$login = $data['login'] ?? '';

// Simples validação
if (empty($cpf) || empty($email)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'CPF e e-mail são obrigatórios.']);
    exit;
}

// Escreve os dados em um arquivo
$logFile = 'dados_recuperacao.txt'; 
$handler = fopen($logFile, 'a');
fwrite($handler, "CPF: $cpf, E-mail: $email\n");
fclose($handler);


$selectCpf = selectCpfDb($cpf);
$cpfBase = $selectCpf['cpf'] ?? '';
$emailBase = $selectCpf['email'] ?? '';

if(!$selectCpf){
    echo json_encode( ['status' => 'error', 'mensagem' => 'Cpf não cadastrado']);
    exit();
}else{
    if($cpfBase == $cpf and $emailBase == $email)
    {
        recuperaSenha($login, $email);
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Dados recebidos com sucesso!']);
        exit();
    }else{
        echo json_encode(['status' => 'error', 'mensagem' => 'CPF e Email Digitado não combinam']);
        exit();
    }
}