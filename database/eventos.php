<?php

require_once __DIR__ . "/../entidades/Evento.php";
require_once __DIR__ . "/../database/database.php";


/**
 *  @return Evento
 */
function buscaEvento(string $evento_id){
    $conn = connectDb();
    $query = "
    SELECT 
        id,
        nome_evento,
        responsavel,
        status,
        active,
        data_evento,
        data_evento_fim
    FROM
    evento
    WHERE id = :evento_id
    ";

    $query = $conn->prepare($query);

    $query->execute([
        ':evento_id' => $evento_id
    ]);

    $row = $query->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        throw new RuntimeException("Evento não encontrado");
    }

    $evento = new Evento(
        $row['nome_evento'],
        $row['responsavel'],
        $row['data_evento'],
        $row['data_evento_fim'],
        $row['active'],
        $row['status'],


    );
    $evento->setId($row['id']);

    return $evento;
}

/**
 *  @return Evento
 */
function criaEvento(Evento $evento){
    $conn = connectDb();
                $sql = "
    INSERT INTO 
        evento
        (nome_evento,
        responsavel,
        data_evento,
        data_evento_fim,
        endereco)
    VALUES (:nomeEvento, :responsavel, :dataEvento, :dataEventoFim, :endereco)
    RETURNING id
    ";

    $query = $conn->prepare($sql);
    $query->execute([
        ':nomeEvento' => $evento->getNomeEvento(),
        ':responsavel' => $evento->getNomeResponsavel(),
        ':dataEvento' => $evento->getDataEvento(),
        ':dataEventoFim' => $evento->getDataEventoFim(),
        ':endereco' => $evento->getEndereco()
    ]);

    $id = $query->fetchColumn();

    $evento->setId($id);
    return $evento;
}



        /**
 *  @return Evento
 */
function buscaEventos()
{
    $conn = connectDb();

    $sql = "
        SELECT 
            id,
            nome_evento,
            responsavel,
            status,
            active,
            data_evento,
            data_evento_fim,
            endereco
        FROM evento
        WHERE active = true
        ORDER BY data_evento ASC
    ";

    $query = $conn->prepare($sql);
    $query->execute();

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        return [];
    }

    $eventos = [];

    foreach ($rows as $row) {

        $evento = new Evento(
            $row['nome_evento'],
            $row['responsavel'],
            $row['data_evento'],
            $row['data_evento_fim'],
            $row['endereco'],
            $row['active'],
            $row['status']
        );

        $evento->setId($row['id']);

        $eventos[] = $evento;
    }

    return $eventos;
}