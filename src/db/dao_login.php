<?php
session_start();
require_once('connection.php');
require_once('../functions/functions.php');

if (isset($_POST['login'])) {

    $conn = Connection::newConnection();
    $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));

    //Validação de Password e Senha 
    $checkPass = checkPassword($email, $password);

    //Validação se usuário está ativo
    $statusUser = userIsActive($email);

    if ($checkPass && $email == 'gabrielmboeira@gmail.com') {
        $_SESSION['adm_prog'] = 'adm_check';
        $userID = $checkPass['id'];
        $_SESSION['userID'] = $userID;
        header('location: ../../users');
        die;
    }

    if ($checkPass && $statusUser['status'] == 'active') {

        $userID = $checkPass['id'];
        $_SESSION['userID'] = $userID;
        header('location: ../../question');

    } else if ($checkPass && $statusUser['status'] == 'pending') {

        //Se já gerou ticket mas está pendente
        if ($ticketUrl = getTicketUrlbyEmail($email)) {
            $_SESSION['login_msg'] =  "<div class='alert alert-danger m-1' role='alert'> E-mail já foi cadastrado! <a href='$ticketUrl' class='alert-link'>Liberar acesso!</a></div>";
            header('location: ../../login');
            die;
        }

        $_SESSION['login_msg'] =  "<div class='alert alert-msg-login alert-danger m-1' role='alert'> Usuário cadastrado, aguardando liberação! </div>";
        header('location: ../../login');

    } else {

        $_SESSION['login_msg'] =  "<div class='alert alert-msg-login alert-danger m-1' role='alert'> Email não cadastrado ou senha incorreta! </div>";
        header('location: ../../login');
    }

    $conn->close();
}
