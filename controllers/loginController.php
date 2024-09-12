<?php
session_start();

if ($_POST['login'] == 'admin' && $_POST['senha'] == '1234')
{
    $_SESSION['username'] = 'admin';
    $_SESSION['cpf'] = '1234cpf';
    $_SESSION['email'] = 'admin@gmail.com';

    echo "Sessao do: " .  $_SESSION['username'];
    header("location: ./adicionarQr.php");
}
else {echo "XIIIIIIIIIIIIIII";}