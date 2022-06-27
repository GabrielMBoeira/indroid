<?php
session_start();
require_once('connection.php');
require_once('../functions/functions.php');

if (isset($_POST['login'])) {

    $conn = newConnection();

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    //Validação de Password e Senha 
    $checkPass = checkPassword($email, $password);

    //Validação se usuário está ativo
    $userIsActive = userIsActive($email);


    if ($checkPass) {

        $userID = $checkPass['id'];
        $_SESSION['userID'] = $userID;
        header('location: ../../question');

    } else {

        $_SESSION['login_msg'] =  "<div class='alert alert-msg-login alert-danger m-1' role='alert'> Email não cadastrado ou senha incorreta! </div>";
        header('location: ../../login');
        
    }

    $conn->close();
}
