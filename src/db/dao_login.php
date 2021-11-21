<?php
session_start();
require_once('connection.php');
require_once('../config/accessAdm.php');
require_once('../functions/functions.php');


if ($_POST['email'] === "gabrielmboeira@gmail.com" && $_POST['password'] === 'gabriel') {
    header('location: ../../question');
} else {
    header('location: ../../login');
}


// if (isset($_POST['login'])) {

//     $conn = newConnection();

//     $dados = $_POST;

//     $email = htmlspecialchars($dados['email']);
//     $password = htmlspecialchars($dados['password']);

//     $email = mysqli_real_escape_string($conn, $email);
//     $password = mysqli_real_escape_string($conn, $password);

//     //Função de redirecionamento caso administrador
//     accessAdm($email, $password);

//     //Validação de Password e Senha 
//     $checkPass = checkPassword($email, $password);

//     //Validação se usuário está ativo
//     $userIsActive = userIsActive($email);


//     if ($checkPass) {

//         $userID = $checkPass['id_user'];
//         $_SESSION['userID'] = $userID;

//         if ($userIsActive['status'] == 'active') {
//             header('location: ../../question');
//         } else {
//             header('location: ../../registration_pending');
//         }
//     } else {

//         $_SESSION['login_msg'] =  "<div class='alert alert-msg-login alert-danger m-1' role='alert'> Email não cadastrado ou senha incorreta! </div>";
//         header('location: ../../login');
//     }

//     $conn->close();
// }
