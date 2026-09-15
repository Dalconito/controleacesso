<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);

    echo json_encode([
        'status' => false,
        'message' => 'Método não permitido'
    ]);

    exit;
}

header('Content-Type: application/json');

require_once __DIR__ . '/../entidades/CodigoQr.php';
require_once __DIR__ . '/CEQr.php';
require_once __DIR__ . '/../phpqrcode-master/qrlib.php';

try {

    $dataPost = json_decode(
        file_get_contents('php://input'),
        true
    );

    if (!is_array($dataPost)) {
        http_response_code(400);

        echo json_encode([
            'status' => false,
            'message' => 'Dados inválidos'
        ]);

        exit;
    }

    $cpf = $dataPost['cpfPost'] ?? null;

    if (!$cpf) {
        http_response_code(400);

        echo json_encode([
            'status' => false,
            'message' => 'CPF não informado'
        ]);

        exit;
    }

    $codigosQr = buscarCodigosQr($cpf);

    if (empty($codigosQr)) {
        http_response_code(404);

        echo json_encode([
            'status' => false,
            'message' => 'Nenhum QR Code encontrado para este CPF',
            'codigosQr' => []
        ]);

        exit;
    }

    $resultado = [];

    foreach ($codigosQr as $codigoQr) {

        ob_start();

        QRcode::png(
            $codigoQr->getId(),
            null,
            QR_ECLEVEL_L,
            10
        );

        $imageString = base64_encode(
            ob_get_clean()
        );

        $resultado[] = [
            'id' => $codigoQr->getId(),
            'cpf' => $codigoQr->getCpf(),
            'idIngresso' => $codigoQr->getIdIngresso(),
            'idEvento' => $codigoQr->getIdEvento(),
            'quantidade' => $codigoQr->getQtde(),
            'qrCodeImage' => $imageString
        ];
    }

    echo json_encode([
        'status' => true,
        'message' => 'QR Codes encontrados',
        'codigosQr' => $resultado
    ]);
} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        'status' => false,
        'message' => 'Erro ao consultar banco de dados',
        'error' => $e->getMessage()
    ]);
} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([
        'status' => false,
        'message' => 'Erro interno',
        'error' => $e->getMessage()
    ]);
}
