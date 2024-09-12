<?php

function connectDB(){
    
    $servidor = "pitaspark.mysql.uhserver.com"; $usuario = "dalconito";
    $senha = "Helloworld*89"; $banco = "pitaspark";
    $conexao = mysqli_connect($servidor,$usuario,$senha,$banco);
    return $conexao;}

    function getProduto(){$conexao = connectDB();
        $selectDBquery = "SELECT * FROM usuarios order by id asc;";
        $resultQuery = mysqli_query($conexao, $selectDBquery);
        $conexao->close();
        return $resultQuery;}

function adicionarUsr()
{$conexao = connectDB();
    $nome = "Leoni Terto";
    $senha = "12332465235";
    $email = "terto.leoni@outlook.com";
    $cpf = "48574472826";
$sqlQuery = "INSERT INTO usuarios (nome, senha, email, cpf) VALUES (?, ?, ?, ?)";
$prepQuery = $conexao->prepare($sqlQuery);
if($prepQuery == false) {die("Erro na preparação da consulta");}
$prepQuery->bind_param("ssss", $nome, $senha, $email, $cpf);
if($prepQuery->execute()) {echo "Usuario Adicionado";} else {echo "Erro: " . $prepQuery->error;}
$prepQuery->close(); $conexao->close();}

$retorno = getProduto();

foreach ($retorno as $ret)
{
    echo $ret['id'];
    echo $ret['nome'];
    echo $ret['cpf'];
    echo $ret['email'];
    echo "<br>";
}