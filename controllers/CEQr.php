<?php
require_once(__DIR__ . "/../database/database.php");
require_once __DIR__ . "/print.php";
require_once __DIR__ . "/../entidades/CodigoQr.php";

function createQrCode(CodigoQr $codigoQR)
{
    $conn = connectDb();

    $sql = "
        INSERT INTO qrcode
        (stat, id_ingresso, cpf, qtde, evento_id)
        VALUES
        (:stat, :id_ingresso, :cpf, :qtde, :evento_id)
        RETURNING qrcodeid
        ";

    $query = $conn->prepare($sql);

    $query->execute([
        ':stat' => '0',
        ':id_ingresso' => $codigoQR->getIdIngresso(),
        ':cpf' => $codigoQR->getCpf(),
        ':qtde' => $codigoQR->getQtde(),
        ':evento_id' => $codigoQR->getIdEvento()
    ]);

    $id = $query->fetchColumn();

    $codigoQR->setId($id);

    return $codigoQR;
}

/**
 * @return CodigoQr[]
 */
function buscarCodigosQr(string $cpf): array
{
    $conn = connectDb();

    $sql = "
        SELECT
            qrcodeid,
            cpf,
            id_ingresso,
            qtde,
            evento_id,
            status
        FROM qrcode
        WHERE cpf = :cpf
        ORDER BY qrcodeid
    ";

    $query = $conn->prepare($sql);

    $query->execute([
        ':cpf' => $cpf
    ]);

    $codigosQr = [];

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $codigosQr[] = CodigoQr::fromDatabase(
            $row['qrcodeid'],
            $row['cpf'],
            $row['id_ingresso'],
            $row['evento_id'],
            $row['status'],
            (int) $row['qtde']
        );
    }

    return $codigosQr;
}
