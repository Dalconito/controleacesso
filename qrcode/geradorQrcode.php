<?php
include_once "./phpqrcode-master/qrlib.php";
include_once "../htdocs/library/PHPMailer-master/src/PHPMailer.php";
include_once "../htdocs/library/PHPMailer-master/src/SMTP.php";
include_once "../htdocs/library/PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function connectDb()
{
    $server = "192.168.3.35"; $user = "dalconito"; $pass = "HelloWorld"; $database = "fabrica";
    $conn = mysqli_connect($server, $user, $pass, $database);
    return $conn;}

function Query($idQrCode)
{$conn = connectDb();
    $selectQuery = "SELECT * FROM qrcode where id = $idQrCode";
    $resultQuery = mysqli_query($conn, $selectQuery);
    $returnQuery = mysqli_fetch_assoc($resultQuery);
    $conn->close(); return $returnQuery;}

function gerarQrCode($texto)
{QRcode::png($texto, 'qrcode.jpeg', QR_ECLEVEL_L, 10);
    return QRcode::png($texto);}

function sendMail($qrCodeImg){
    try {
        $mail = new PHPMailer(true);
        // Configurações do servidor SMTP
        $mail->isSMTP();                                      // Definir o uso de SMTP
        $mail->Host       = 'smtp.exemplo.com';               // Endereço do servidor SMTP
        $mail->SMTPAuth   = true;                             // Ativar autenticação SMTP
        $mail->Username   = 'seuemail@exemplo.com';           // Usuário SMTP
        $mail->Password   = 'suasenha';                       // Senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Habilita criptografia TLS
        $mail->Port       = 587;                              // Porta TCP do SMTP
    
        // Remetente e destinatários
        $mail->setFrom('seuemail@exemplo.com', 'Seu Nome');
        $mail->addAddress('destinatario@exemplo.com', 'Nome Destinatário');
    
        // Conteúdo do e-mail
        $mail->isHTML(true);                                  // Define o formato como HTML
        $mail->Subject = 'Assunto do e-mail';
        $mail->Body    = 'Este é o <b>corpo do e-mail</b> em HTML';
        $mail->AltBody = 'Este é o corpo do e-mail em texto simples para leitores de e-mail que não suportam HTML';
    
        // Envia o e-mail
        $mail->send();
        echo 'E-mail enviado com sucesso!';
    } catch (Exception $e) {
        echo "Falha no envio do e-mail. Mailer Error: {$mail->ErrorInfo}";
    }
}