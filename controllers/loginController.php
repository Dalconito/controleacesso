<?php
$loginUser = isset($_POST['login']) ? $_POST['login'] : null;
$senhaUser = isset($_POST['senha']) ? $_POST['senha'] : null;
if ($loginUser == 'admin' && $senhaUser == '1234')
{
    $_SESSION['username'] = 'admin';
    $_SESSION['cpf'] = '1234cpf';
    $_SESSION['email'] = 'admin@gmail.com';

    echo "Sessao do: " .  $_SESSION['username'];
    header("location: ./adicionarQr.php");
}
else {echo "XIIIIIIIIIIIIIII";}