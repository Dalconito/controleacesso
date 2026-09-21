<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../entidades/Ingresso.php';


function buscaIngressosPorEvento(string $idEvento): array
{
    $conn = connectDb();

    $sql = "
        SELECT
            id,
            cpf,
            id_ingresso,
            evento_id,
            qtde,
            status
        FROM ingresso
        WHERE evento_id = :evento_id
          AND active = true
        ORDER BY created DESC
    ";

    $query = $conn->prepare($sql);

    $query->execute([
        ':evento_id' => $idEvento
    ]);

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        return [];
    }

    $ingressos = [];

    foreach ($rows as $row) {

        $ingressos[] = Ingresso::fromDatabase(
            $row['id'],
            $row['cpf'],
            $row['id_ingresso'],
            $row['evento_id'],
            (int) $row['qtde'],
            (int) $row['status']
        );
    }

    return $ingressos;
}