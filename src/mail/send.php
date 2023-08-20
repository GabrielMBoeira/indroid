<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendForgotEmail($email, $hash)
{

    $envPath = realpath(dirname(__FILE__, 3) . '/.env');
    $env = parse_ini_file($envPath);

    $username = $env['USERNAME'];
    $password = $env['PASSWORD'];

    //Load Composer's autoloader
    require_once(dirname(__FILE__, 3) . '/vendor/autoload.php');

    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;      //Enable verbose debug output
        $mail->isSMTP();                            //Send using SMTP
        $mail->Host       = 'smtp.hostinger.com';   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                   //Enable SMTP authentication
        $mail->Username   = $username;              //SMTP username
        $mail->Password   = $password;              //SMTP password
        $mail->SMTPSecure =  'ssl';                 //Enable ssl encryption
        $mail->Port       = 465;                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';

        $name_from = 'Indroid';
        $email_from = 'suporte@indroid.com.br';
        $email_to = $email;

        //Recipients
        $mail->setFrom($email_from, $name_from);
        $mail->addAddress($email_to);
        // $mail->addReplyTo('ellen@example.com', 'Indroid');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        $mail->isHTML(true);
        // $mail->WordWrap = 50;  

        $mail->Subject = 'introdução';
        $mail->Body    = "
                            Olá! 
                            <br>
                            <br>
                            <b>Vocêee solicitou a recuperação de senha para o aplicativo inDroid!</b>
                            <p>Observação: Para efetuar a recuperação de senha clique no link abaixo.</p>
                            <br>
                            <br>
                            <a href='https://www.indroid.com.br/alter_password_forgot?user=" . $email . "&key=" . $hash . "'>Clique aqui para recuperar senha!</a>
                            ";

        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

    } catch (Exception $e) {
        echo "Mensagem não pode ser enviada para $email_to!. Mailer Error: {$mail->ErrorInfo}";
    }
}
