<?php 
function connectDb(){
    $host = "localhost";
    $user = "root";
    $database = "fabrica";
    $senha = "";
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
