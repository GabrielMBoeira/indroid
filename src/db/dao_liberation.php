<?php

session_start();

require_once('connection.php');
require_once('../functions/functions.php');
require_once('../../vendor/phpmailer/phpmailer/src/actionsEmails/sendForgotEmail.php');

$conn = newConnection();

$userID = mysqli_real_escape_string($conn, $_GET['id']);
$status = 'active';

$email = getEmailById($userID);
$emailString =  implode('"', $email);  

$sql = "UPDATE login SET status = ? WHERE id_user = ? ";

$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $status, $userID);

if ($stmt->execute()) {

    $_SESSION['liberation-msg'] =  "<div class='alert alert-success' role='alert'> Liberado com sucesso! </div>";

    // Enviando email de Acesso Liberado para Usuário
    if ($status === 'active') {
        liberationConfirm($emailString);
    }

    header('location: ../../users');
} else {

    $_SESSION['liberation-msg'] =  "<div class='alert alert-danger' role='alert'> Erro ao liberar, veirificar com suporte </div>";
    header('location: ../../users');
}

$conn->close();
