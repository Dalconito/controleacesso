<?php
use PHPMailer\PHPMailer\PHPMailer;
require './vendor/autoload.php';

$mail = new PHPMailer(true);
echo "PHPMailer carregado com sucesso!";