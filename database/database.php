<?php 

function connectDb(){
    $host = "webdecision.mysql.uhserver.com";
    $user = "dalconito";
    $database = "webdecision";
    $senha = "HelloWorld*89";
    $conn = mysqli_connect($host, $user, $senha, $database);
    return $conn;
}

function select($postData){
    $conn = connectDb();
    $selectDbQuery = "SELECT * FROM qrcode WHERE qrcodeid=? ";
    $query = $conn->prepare($selectDbQuery);
    if($query === false){echo"DEU ERRO NO PREPARAR";}
    $query->bind_param("s", $postData);

    if($query->execute()){
        $resultDbQuery = $query->get_result();
        $resultQuery = $resultDbQuery->fetch_assoc();
    }
    else {echo "NAO DEU CERTO A SELECAO";}
    $query->close(); $conn->close();
    return $resultQuery;
}

function selectUser($postData){
    $conn = connectDb();
    $selectDbQuery = "SELECT * FROM usuarios WHERE loginusr=? ";
    $query = $conn->prepare($selectDbQuery);
    if($query === false){echo "DEU RUIM";}
    $query->bind_param("s", $postData);

    if($query->execute()){
        $resultDbQuery = $query->get_result();
        $resultQuery = $resultDbQuery->fetch_assoc();
    }
    else {echo "NAO DEU CERTO A SELECAO";}
    $query->close(); $conn->close();
    return $resultQuery;
}


function selectCpfDb($cpf){
    $conn = connectDb();
    $selectDbQuery = "SELECT * FROM usuarios WHERE cpf= '$cpf' ";
    $resultDbQuery = mysqli_query($conn, $selectDbQuery);
    $resultQuery = mysqli_fetch_assoc($resultDbQuery);
    $conn->close();
    return $resultQuery;
}

function selectCpfQtde($cpf){
    $conn = connectDb();
    $selectDbQuery = "SELECT qtde FROM usuarios WHERE cpf= '$cpf' ";
    $resultDbQuery = mysqli_query($conn, $selectDbQuery);
    $resultQuery = mysqli_fetch_assoc($resultDbQuery);
    $conn->close();
    return $resultQuery;
}

function selectperso($pesquisa, $dado) {
    $conn = connectDb();
    
    // Escapar o dado para evitar injeção de SQL
    $dado = mysqli_real_escape_string($conn, $dado);
    
    // Montar a query para buscar a existência do dado
    $selectDbQuery = "SELECT 1 FROM usuarios WHERE $pesquisa = '$dado' LIMIT 1";
    
    $resultDbQuery = mysqli_query($conn, $selectDbQuery);
    
    // Verifica se retornou algum resultado
    $exists = mysqli_num_rows($resultDbQuery) > 0;
    
    $conn->close();
    return $exists; // Retorna true se existir, false caso contrário
}
