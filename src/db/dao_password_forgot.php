<?php
session_start();

require_once('connection.php');
require_once('../functions/functions.php');
// require_once('../../vendor/phpmailer/phpmailer/src/actionsEmails/sendForgotEmail.php');

// array(2) { ["email"]=> string(24) "gabrielmboeira@gmail.com" ["password_forgot"]=> string(0) "" }

$conn = newConnection();

$email = mysqli_real_escape_string($conn, trim($_POST['email']));

if (existEmail($email)) {

    // Gerando chave para alteração de senha
    $hash = newKeyAccess($email);

    // Disparando envio de email para usuário
    // sendForgotEmail($email, $hash);

    $_SESSION['alter_password-msg'] =  "<div class='alert alert-success' role='alert'>Email de recuperação enviado! <a href='login' class='alert-link'>Login!</a></div>";
    header('location: ../../password_forgot');


} else {

    $_SESSION['alter_password-msg'] =  "<div class='alert alert-danger mb-3' role='alert'> Email não cadastrado! </div>";
    header('location: ../../password_forgot');
}

$conn->close();
