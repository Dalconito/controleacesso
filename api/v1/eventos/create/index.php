<?php
require_once __DIR__ . "/../../../entidades/Evento.php";
require_once __DIR__ . "/../../../database/eventos.php";

header('Content-Type: application/json; charset=utf-8');

try {

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    if (!$dados) {
        throw new Exception('Dados inválidos.');
    }

    $nomeEvento = trim($dados['nomeEvento'] ?? '');
    $responsavel = trim($dados['Responsavel'] ?? '');
    $dataInicio = $dados['dataInicio'] ?? '';
    $dataTermino = $dados['dataTermino'] ?? '';
    $endereco = trim($dados['endereco'] ?? '');

    // Validação no backend também
    if (
        !$nomeEvento ||
        !$responsavel ||
        !$dataInicio ||
        !$dataTermino ||
        !$endereco
    ) {
        throw new Exception('Todos os campos são obrigatórios.');
    }

    // Debug temporário
    error_log(print_r($dados, true));

    $evento = new Evento($nomeEvento, $responsavel, $dataInicio, $dataTermino, $endereco);

    criaEvento($evento);

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Evento cadastrado com sucesso!'
    ]);

} catch (Exception $e) {

    http_response_code(400);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => $e->getMessage()
    ]);
}