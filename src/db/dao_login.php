<?php
session_start();
require_once('connection.php');
require_once('../config/accessAdm.php');
require_once('../functions/functions.php');

if (isset($_POST['login'])) {

    $conn = newConnection();

    $dados = $_POST;

    $email = htmlspecialchars($dados['email']);
    $password = htmlspecialchars($dados['password']);

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $checkPass = checkPassword($email, $password);
    $userIsActive = userIsActive($email);

    //Função de redirecionamento caso administrador
    accessAdm($email, $password);

    if ($checkPass) {

        $userID = $checkPass['id_user'];
        $_SESSION['userID'] = $userID;

        if ($userIsActive['status'] == 'active') {
            header('location: ../../question');
        } else {
            header('location: ../../registration_pending');
        }
    } else {

        $_SESSION['login_msg'] =  "<div class='alert alert-msg-login alert-danger m-1' role='alert'> Email nÃ£o cadastrado ou senha incorreta! </div>";
        header('location: ../../login');
    }

    $conn->close();
}
