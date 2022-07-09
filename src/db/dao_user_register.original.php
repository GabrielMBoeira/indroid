<?php
session_start();

require_once('connection.php');
require_once('../functions/functions.php');

$conn = newConnection($env);

$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password_confirm = mysqli_real_escape_string($conn, $_POST['password_cofirm']);
$checkbox = mysqli_real_escape_string($conn, $_POST['checkbox']);
$status = 'pending';


//Verificando se email já é existente
$email_exist = getEmail($email, $env);


if ($email_exist) {
    $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Este e-mail já está cadastrado!</div>";
    header('location: ../../user_register.php');
}

if ($password !== $password_confirm) {
    $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Senhas não conferem! </div>";
    header('location: ../../user_register.php');
}

if ($checkbox === 'on') {

    $email = strtolower($email);

    //Criptografando senha
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, phone, password, status) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $email, $phone, $passwordHash, $status);

    if ($stmt->execute()) {

        $userID = getIdUser($email, $env);
        $_SESSION['userID'] = $userID;

        $_SESSION['register_msg'] =  "<div class='alert alert-success m-1' role='alert'>Registro cadastrado com sucesso. <a href='login.php' class='alert-link'>Acesse Login!</a> </div>";
        header('location: ../../user_register.php');
    } else {

        $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Entre em contato com suporte </div>";
        header('location: ../../user_register.php');
    }
} else {

    $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Senhas não conferem ou e-mail já cadastrado </div>";
    header('location: ../../user_register.php');
}

$conn->close();
