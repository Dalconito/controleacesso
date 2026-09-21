<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../../controllers/ingressoSeeder.php';

try {

    $dados = json_decode(
        file_get_contents('php://input'),
        true
    );

    $quantidade = (int) ($dados['quantidade'] ?? 0);
    $idEvento = $dados['idEvento'] ?? null;

    if ($quantidade <= 0) {
        throw new InvalidArgumentException(
            'Quantidade inválida.'
        );
    }

    if (empty($idEvento)) {
        throw new InvalidArgumentException(
            'Evento não informado.'
        );
    }

    ingressoSeeder($quantidade,$idEvento);

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Ingressos criados com sucesso.'
    ]);

} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}