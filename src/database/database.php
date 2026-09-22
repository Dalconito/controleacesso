<?php

function connectDb()
{
    $host = "postgres";
    $port = "5432";
    $user = "controle";
    $database = "controle_acesso";
    $senha = "controle_senha";

    try {
        $conn = new PDO(
            "pgsql:host=$host;port=$port;dbname=$database",
            $user,
            $senha
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {

        error_log(
            "Erro ao conectar ao PostgreSQL: " . $e->getMessage()
        );

        throw $e;
    }
}


function select($postData)
{
    $conn = connectDb();

    $selectDbQuery = "
        SELECT *
        FROM qrcode
        WHERE qrcodeid = ?
    ";

    $query = $conn->prepare($selectDbQuery);
    $query->execute([$postData]);

    $resultQuery = $query->fetch();

    return $resultQuery;
}


function selectUser($postData)
{
    $conn = connectDb();

    $selectDbQuery = "
        SELECT *
        FROM usuarios
        WHERE loginusr = ?
    ";

    $query = $conn->prepare($selectDbQuery);
    $query->execute([$postData]);

    $resultQuery = $query->fetch();

    return $resultQuery;
}


function selectCpfDb($cpf)
{
    $conn = connectDb();

    $selectDbQuery = "
        SELECT *
        FROM usuarios
        WHERE cpf = ?
    ";

    $query = $conn->prepare($selectDbQuery);
    $query->execute([$cpf]);

    return $query->fetch();
}


function selectCpfQtde($cpf)
{
    $conn = connectDb();

    $selectDbQuery = "
        SELECT qtde
        FROM usuarios
        WHERE cpf = ?
    ";

    $query = $conn->prepare($selectDbQuery);
    $query->execute([$cpf]);

    return $query->fetch();
}


function selectperso($pesquisa, $dado)
{
    $conn = connectDb();

    /*
     * Como $pesquisa representa o nome da coluna,
     * não podemos usar ? diretamente.
     *
     * Por isso, permitimos somente colunas previamente
     * conhecidas.
     */
    $colunasPermitidas = [
        'cpf',
        'loginusr',
        'email'
    ];

    if (!in_array($pesquisa, $colunasPermitidas, true)) {
        throw new InvalidArgumentException("Coluna inválida.");
    }

    $selectDbQuery = "
        SELECT 1
        FROM usuarios
        WHERE $pesquisa = ?
        LIMIT 1
    ";

    $query = $conn->prepare($selectDbQuery);
    $query->execute([$dado]);

    return $query->fetch() !== false;
}
