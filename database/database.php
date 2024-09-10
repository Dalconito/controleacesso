<?php 
function connectDB(){
    $servidor = "192.168.3.35"; $usuario = "dalconito"; $senha = "HelloWorld";
    $banco = "fabrica"; $porta = "3366";
    $conexao = mysqli_connect($servidor,$usuario,$senha,$banco);
    return $conexao;}

function select($postData){
    $conn = connectDB();
    $selectDbQuery = "SELECT * FROM qrcode WHERE qrcodeid=? ";
    $query = $conn->prepare($selectDbQuery);
    if($query === false){printError();}
    $query->bind_param("s", $postData);

    if($query->execute()){
        $resultDbQuery = $query->get_result();
        $resultQuery = $resultDbQuery->fetch_assoc();
        echo "SELECAO PARA VERIFICACAO FEITA";
    }
    else {echo "NAO DEU CERTO A SELECAO";}
    $query->close(); $conn->close();
    return $resultQuery;
}