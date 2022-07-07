<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendForgotEmail($email, $hash) {

$envPath = realpath(dirname(__FILE__, 3) . '/env.ini');
$env = parse_ini_file($envPath);

$username = $env['USERNAME'];
$password = $env['PASSWORD'];

//Load Composer's autoloader
require_once(dirname(__FILE__, 3) . '/vendor/autoload.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                //Enable verbose debug output
    $mail->isSMTP();                                      //Send using SMTP
    $mail->Host       = 'smtp.mailgun.org';               //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                             //Enable SMTP authentication
    $mail->Username   = $username;                        //SMTP username
    $mail->Password   = $password;                        //SMTP password
    $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;  //Enable implicit TLS encryption
    $mail->Port       = 587;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    // $mail->Port       = 465;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    $name_from = 'Indroid';
    $email_from = 'no-reply@indroid.com.br';
    $email_to = $email;

    //Recipients
    $mail->setFrom($email_from , $name_from);
    $mail->addAddress($email_to);    
    // $mail->addAddress('ellen@example.com');                  
    // $mail->addReplyTo('ellen@example.com', 'Indroid');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);   //Set email format to HTML
    // $mail->WordWrap = 50;  
    $mail->Subject = utf8_encode('Teste2');
    $mail->Body    = utf8_encode('Testando HTML <b>Recupera senha!</b>');
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo utf8_encode("Mensagem enviada com sucesso para $email_to!");
} catch (Exception $e) {
    echo utf8_encode("Mensagem n�o pode ser enviada para $email_to!. Mailer Error: {$mail->ErrorInfo}");
}

}
