<?php
// scannerQr.php

// Receber os dados JSON enviados pelo fetch
$data = json_decode(file_get_contents('php://input'), true);

// Processar os dados
if ($data) {
    $nome = $data['nome'];
    $idade = $data['idade'];

    // Retornar uma resposta JSON
    echo json_encode([
        'status' => 'sucesso',
        'mensagem' => 'Dados recebidos com sucesso',
        'nome' => $nome,
        'idade' => $idade
    ]);
} else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Nenhum dado recebido'
    ]);
}

