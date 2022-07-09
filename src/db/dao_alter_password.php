<?php

session_start();

require_once('connection.php');
require_once('../functions/functions.php');

$conn = newConnection($env);

$userID = mysqli_real_escape_string($conn, $_POST['userID']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password_confirm = mysqli_real_escape_string($conn, $_POST['password_cofirm']);

if ($password === $password_confirm) {

    $sql = "UPDATE users SET password = ? WHERE id = ?";

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $passwordHash, $userID);

    if ($stmt->execute()) {

        $_SESSION['alter_password-msg'] =  "<div class='alert alert-success m-1' role='alert'> Senha alterada com sucesso! <a href='login.php' class='alert-link'>Acesse Login!</a> </div>";
        header('location: ../../alter_password.php');

    } else {

        $_SESSION['alter_password-msg'] =  "<div class='alert alert-danger m-1' role='alert'> Erro ao alterar senha!</div>";
        header('location: ../../alter_password.php');

    }

} else {

    $_SESSION['alter_password-msg'] =  "<div class='alert alert-danger m-1' role='alert'> Senhas não conferem! </div>";
    header('location: ../../alter_password.php');
    
}

$conn->close();