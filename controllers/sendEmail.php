<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./../vendor/autoload.php";


function recuperaSenha($userName, $email){
    $mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtps.uhserver.com';  // Defina o servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@controledafabrica.com.br';  // Seu usuário de SMTP
    $mail->Password = 'Contr0le135';  // Sua senha de SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // Recipientes
    $mail->setFrom('no-reply@controledafabrica.com.br', 'Fabrica de Ingressos');
    $mail->addAddress($email, $userName);

    $token = bin2hex(random_bytes(50));  // Gera um token seguro
    $resetLink = "https://controledafabrica.com.br/alterasenha.php?email=" . $email;
    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de Senha';
    $mail->Body    = "
        <h1>Recuperação de Senha</h1>
        <p>Olá.</p>
        <p>Recebemos um pedido para redefinir sua senha. Se foi você, clique no link abaixo para redefinir sua senha:</p>
        <p><a href='{$resetLink}'>Clique aqui para redefinir sua senha</a></p>
        <br>
        <p>Se você não solicitou a redefinição de senha, ignore este e-mail. Alguém pode estar tentando acessar sua conta indevidamente.</p>
        <p>Por favor, não compartilhe este link com ninguém para evitar fraudes.</p>
        <br>
        <p>Atenciosamente,<br>Site da Fabrica</p>
    ";
    $mail->AltBody = "Olá. Use este link para redefinir sua senha: {$resetLink}. Se não foi você, ignore este e-mail.";

    $mail->send();
    return ['status' => 'sucesso', 'mensagem' => 'E-mail enviado com sucesso!'];
} catch (Exception $e) {
    return ['status' => 'erro', 'mensagem' => 'Falha no envio do e-mail. Erro: ' . $mail->ErrorInfo];
}
}