<?php
session_start();
require_once('../api/mercadopago.php');
require_once(dirname(__FILE__) . '/connection.php');
require_once(dirname(__FILE__) . '/../functions/functions.php');

$conn = Connection::newConnection();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password_confirm = mysqli_real_escape_string($conn, $_POST['password_cofirm']);
$checkbox = mysqli_real_escape_string($conn, $_POST['checkbox']);
$status = 'pending';

//Verificando se email já é existente
$email_exist = getEmail($email);

if ($email_exist) {

    //Se já gerou ticket mas está pendente
    if ($ticketUrl = getTicketUrlbyEmail($email_exist['email'])) {
        $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> E-mail já foi cadastrado (liberação está pendente)! <a href='$ticketUrl' class='alert-link'>Liberar acesso!</a></div>";
        header('location: ../../user_register');
        die;

    }

    $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Este e-mail já está cadastrado!</div>";
    header('location: ../../user_register');
    die;
}

if ($password != $password_confirm) {
    $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Senhas não conferem! </div>";
    header('location: ../../user_register');
    die;
}

if ($checkbox === 'on') {

    $email = strtolower($email);

    //Criptografando senha
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //Integração com mercado pago
    $payment = mercadoPagoBuilderPayment($email, 1, 1.00);
    $payment_ticket_url = $payment->point_of_interaction->transaction_data->ticket_url;

    $sql = "INSERT INTO users (email, phone, password, status, payment_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $email, $phone, $passwordHash, $status, $payment->id);

    if ($stmt->execute()) {

        $userID = getIdUser($email);
        $_SESSION['userID'] = $userID;

        $_SESSION['register_msg'] =  "<div class='alert alert-success m-1' role='alert'>Registro cadastrado com sucesso. <a href='login' class='alert-link'>Acesse Login!</a> </div>";
        header("location: ". $payment_ticket_url ."");
    } else {

        $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Entre em contato com suporte </div>";
        header('location: ../../user_register');
    }
} else {

    $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Senhas não conferem ou e-mail já cadastrado </div>";
    header('location: ../../user_register');
}

$conn->close();
