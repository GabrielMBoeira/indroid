<?php

session_start();

require_once('connection.php');
require_once('../functions/functions.php');

$conn = newConnection();

$userID = mysqli_real_escape_string($conn, $_GET['id']);
$status = 'active';


$sql = "UPDATE login SET status = ? WHERE id_user = ? ";

$stmt = $conn->prepare($sql);
$stmt ->bind_param('si', $status, $userID);

if ($stmt->execute()) {

    $_SESSION['liberation-msg'] =  "<div class='alert alert-success' role='alert'> Liberado com sucesso! </div>";
    header('location: ../../users');

} else {

    $_SESSION['liberation-msg'] =  "<div class='alert alert-danger' role='alert'> Erro ao liberar, veirificar com suporte </div>";
    header('location: ../../users');

}

$conn->close();