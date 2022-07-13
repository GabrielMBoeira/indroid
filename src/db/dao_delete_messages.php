<?php

session_start();

require_once('connection.php');
require_once('../functions/functions.php');

$conn = Connection::newConnection();

$idMessage = mysqli_real_escape_string($conn, $_GET['id']);

$idMessage =  intval($idMessage);  

var_dump($idMessage);

$sql = " DELETE FROM messages WHERE id = ? ";

$stmt = $conn->prepare($sql);
$stmt ->bind_param('i', $idMessage);

if ($stmt->execute()) {

    header('location: ../../messages');

} else {

    $_SESSION['messages-msg'] =  "<div class='alert alert-danger' role='alert'> Não foi possível deletar, acionar suporte. </div>";
    header('location: ../../messages');

}

$conn->close();