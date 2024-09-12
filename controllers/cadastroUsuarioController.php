<?php

function connectDbUsuarios(){
    $host = "webdecision.mysql.uhserver.com";
    $user = "dalconito";
    $database = "webdecision";
    $senha = "HelloWorld*89";

   $conn = mysqli_connect($host, $user, $senha, $database);
    return $conn;
}

function createUser($login,$cpf,$email,$tipoConta,$senha ){
    $conn = connectDbUsuarios();
    $query = "INSERT INTO usuarios (login, cpf, email,tipo_conta, senha) VALUES (?,?,?,?,?);";
    $queryCreate = $conn->prepare($query);
    if($queryCreate === false){echo "Erro ao preparar";}
    $queryCreate->bind_param('sssis', $login,$cpf,$email,$tipoConta,$senha);

    if($queryCreate->execute()){
        echo "usuario criado com sucesso";
    }else {"Erro ao Criar Usuario";}
    $queryCreate->close(); $conn->close();
}

