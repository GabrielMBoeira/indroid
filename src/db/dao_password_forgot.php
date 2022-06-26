<?php
session_start();

require_once('connection.php');
require_once('../functions/functions.php');
// require_once('../../vendor/phpmailer/phpmailer/src/actionsEmails/sendForgotEmail.php');


if (isset($_POST['password_forgot'])) {

    $conn = newConnection();

    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $email = htmlspecialchars(trim($email));

    if (existEmail($email)) {

        // Gerando chave para alteração de senha
        $hash = newKeyAccess($email);
        
        // Disparando envio de email para usuário
        // sendForgotEmail($email, $hash);

        // $_SESSION['alter_password-msg'] =  "<div class='alert alert-success' role='alert'>Email de recuperação de senha enviado! <a href='login' class='alert-link'>Login!</a></div>";
        // header('location: ../../password_forgot');
    } else {
        
        // $_SESSION['alter_password-msg'] =  "<div class='alert alert-danger mb-3' role='alert'> Email não cadastrado! </div>";
        // header('location: ../../password_forgot');
    }

    $conn->close();
}
