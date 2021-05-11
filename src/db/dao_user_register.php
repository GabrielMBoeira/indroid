<?php

session_start();

require_once('connection.php');
require_once('../functions/functions.php');

$conn = newConnection();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password_confirm = mysqli_real_escape_string($conn, $_POST['password_cofirm']);
$checkbox = mysqli_real_escape_string($conn, $_POST['checkbox']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$status = 'pending';

//Retornando o Email caso exista
$email_exist = getEmail($email); 

if ($password === $password_confirm && $checkbox === 'on' && !$email_exist) {

    $email = strtolower($email);

    //Criptografando senha
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO login (email, phone, password, status) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $email, $phone, $passwordHash, $status);

    if ($stmt->execute()) {

        $userID = getIdUser($email);
        $_SESSION['userID'] = $userID;

        header('location: ../../registration_completed');

    } else {

        $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Entre em contato com suporte </div>";
        header('location: ../../user_register');

    }

} else {

    $_SESSION['register_msg'] =  "<div class='alert alert-danger m-1' role='alert'> Senhas não conferem ou e-mail já cadastrado </div>";
    header('location: ../../user_register');
    
}

$conn->close();