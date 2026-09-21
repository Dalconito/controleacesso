<?php
require_once(__DIR__ . "/../database/database.php");
require_once __DIR__ . "/print.php";
require_once __DIR__ . "/../entidades/Ingresso.php";

function createQrCode(Ingresso $ingresso)
{
    $conn = connectDb();

    $sql = "
        INSERT INTO ingresso
        (id_ingresso, cpf, qtde, evento_id)
        VALUES
        (:id_ingresso, :cpf, :qtde, :evento_id)
        RETURNING id
        ";

    $query = $conn->prepare($sql);

    $query->execute([
        ':id_ingresso' => $ingresso->getIdIngresso(),
        ':cpf' => $ingresso->getCpf(),
        ':qtde' => $ingresso->getQtde(),
        ':evento_id' => $ingresso->getIdEvento()
    ]);

    $id = $query->fetchColumn() ;

    $ingresso->setId($id);

    return $ingresso;
}

/**
 * @return Ingresso[]
 */
function buscarCodigosQr(string $cpf): array
{
    $conn = connectDb();

    $sql = "
        SELECT
            id,
            cpf,
            id_ingresso,
            qtde,
            evento_id,
            status
        FROM ingresso
        WHERE cpf = :cpf
        ORDER BY updated
    ";

    $query = $conn->prepare($sql);

    $query->execute([
        ':cpf' => $cpf
    ]);

    $codigosQr = [];

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $codigosQr[] = Ingresso::fromDatabase(
            $row['id'],
            $row['cpf'],
            $row['id_ingresso'],
            $row['evento_id'],
            (int) $row['qtde'],
            $row['status']
        );
    }

    return $codigosQr;
}
