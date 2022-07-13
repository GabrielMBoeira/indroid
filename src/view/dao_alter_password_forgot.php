<?php

session_start();

require_once('connection.php');
require_once('../functions/functions.php');

$conn = newConnection();

$userID = mysqli_real_escape_string($conn, $_POST['userID']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password_confirm = mysqli_real_escape_string($conn, $_POST['password_cofirm']);

if ($password === $password_confirm) {

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $passwordHash, $userID);

    if ($stmt->execute()) {

        $_SESSION['alter_password-forgot-msg'] =  "<div class='alert alert-success m-1' role='alert'> Senha alterada com sucesso. <a href='login' class='alert-link'>Acesse Login!</a> </div>";
        header('location: ../../alter_password_forgot');

    } else {

        $_SESSION['alter_password-forgot-msg'] =  "<div class='alert alert-danger m-1' role='alert'> Erro ao alterar senha! </div>";
        header('location: ../../alter_password_forgot');

    }

} else {

    $_SESSION['alter_password-forgot-msg'] =  "<div class='alert alert-danger m-1' role='alert'> Senhas não conferem! </div>";
    header('location: ../../alter_password_forgot');
    
}

$conn->close();