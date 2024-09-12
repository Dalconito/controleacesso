<?php

function connectDbUsuarios(){
    $host = "localhost";
    $user = "root";
    $database = "fabrica";
    $senha = "";

   $conn = mysqli_connect($host, $user, $senha, $database);
    return $conn;
}

function createUser($login,$cpf,$email,$senha){
    $conn = connectDbUsuarios();
    $query = "INSERT INTO usuarios (login, cpf, email, senha) VALUES (?,?,?,?);";
    $queryCreate = $conn->prepare($query);
    if($queryCreate === false){echo "Erro ao preparar";}
    $queryCreate->bind_param('ssss',$login,$cpf,$email,$senha);

    if($queryCreate->execute()){
        echo "usuario criado com sucesso";
    }else {"Erro ao Criar Usuario";}
    $queryCreate->close(); $conn->close();
}

