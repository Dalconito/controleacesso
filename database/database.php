<?php 
function connectDB(){
    
    $servidor = "192.168.3.35"; $usuario = "dalconito"; $senha = "HelloWorld";
    $banco = "fabrica"; $porta = "3366";
    $conexao = mysqli_connect($servidor,$usuario,$senha,$banco);
    return $conexao;}