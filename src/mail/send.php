<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require_once(__DIR__ . '/vendor/autoload.php');

// // Configure API key authorization: api-key
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
// // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
// // Configure API key authorization: partner-key
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');
// // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

// $apiInstance = new SendinBlue\Client\Api\AccountApi(
//     // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
//     // This is optional, `GuzzleHttp\Client` will be used as default.
//     new GuzzleHttp\Client(),
//     $config
// );

// try {
//     $result = $apiInstance->getAccount();
//     print_r($result);
// } catch (Exception $e) {
//     echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
// }









// // include 'path/to/mailin-api/Mailin.php';
// $mailin = new Mailin('indroidbot@gmail.com', 'bFCLRqthXxvzyOUP');
// $mailin->
// addTo('indroidbot@gmail.com', 'Indroid Bot')->
// setFrom('indroidbot@gmail.com', 'Indroid Bot')->
// setReplyTo('indroidbot@gmail.com','Indroid Bot')->
// setSubject('Inserir o assunto aqui')->
// setText('Olá')->
// setHtml('<strong>Olá</strong>');
// $res = $mailin->send();

// As mensagens de sucesso foram reenviadas sob esta forma:
// {'result' => true, 'message' => 'E-mail enviado'}







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
    $mail->Host       = 'smtp-relay.sendinblue.com';      //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                             //Enable SMTP authentication
    $mail->Username   = $username;                        //SMTP username
    $mail->Password   = $password;                        //SMTP password
    $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;  //Enable implicit TLS encryption
    // $mail->Port       = 25;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Port       = 587;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    // $mail->Port       = 465;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    $name_from = 'Indroid';
    $email_from = 'no-reply@indroid.com.br';
    $email_to = $email;
    // $email_to = $email;

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
    $mail->Subject = 'Recuperação de senha - Indroid';
    $mail->Body    = "
    
    Testando HTML <br>
    <b>Recupera senha!</b>
    <br>
    <br>
    <a href='https://www.indroid.com.br/alter_password_forgot?user=".$email."&key=".$hash."'>Clique aqui para recuperar senha!</a>


    ";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo utf8_encode("Mensagem enviada com sucesso para $email_to!");
} catch (Exception $e) {
    echo utf8_encode("Mensagem nï¿½o pode ser enviada para $email_to!. Mailer Error: {$mail->ErrorInfo}");
}

}  
