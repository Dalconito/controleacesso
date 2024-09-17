<?php
function printSucesso($msg){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\n$msg com sucesso - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}
function printSucessoDb(){
    $alterFile = "consoleDb.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nBanco de dados conectado com sucesso - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printTest(){
    $alterFile = "teste.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nAté aqui certo - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printError(){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nErro ao preparar a Query - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printInseriu(){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nSucesso ao executar a operacao de bind_param - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}

function printErroExecute($execute){
    $alterFile = "console.log";
    $alterHandle = fopen($alterFile, 'a');
    fwrite($alterHandle, "\nErro ao executar a $execute - " . date("d-m-Y h-i-s"));
    fclose($alterHandle);}
