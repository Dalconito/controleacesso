<?php

session_start();

header('Content-Type: application/json');

require_once __DIR__ . '/../entidades/Ingresso.php';
require_once __DIR__ . '/CEQr.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);

    echo json_encode([
        'status' => 'error',
        'message' => 'Método não permitido'
    ]);

    exit;
}

$nome = $_POST['nomeC'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$idIngresso = $_POST['idIngresso'] ?? null;
$idEvento = $_POST['idEvento'] ?? null;
$quantidade = $_POST['quantidade'] ?? null;

if (!$nome || !$cpf || !$idIngresso || !$idEvento || !$quantidade) {
    http_response_code(400);

    echo json_encode([
        'status' => 'error',
        'message' => 'Dados incompletos'
    ]);

    exit;
}

try {

    $ingresso = new Ingresso(
        $nome,
        $cpf,
        $idEvento,
        (int) $quantidade
    );

    createQrCode($ingresso);

    http_response_code(200);

    echo json_encode([
        'status' => 'success',
        'message' => 'QR Code criado com sucesso'
    ]);
} catch (InvalidArgumentException $e) {

    http_response_code(400);

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}
