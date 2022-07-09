<?php
session_start();

require_once('connection.php');
require_once('../functions/functions.php');

$conn = newConnection($env);

$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$message = mysqli_real_escape_string($conn, trim($_POST['message']));

$email = htmlspecialchars($email);
$message = htmlspecialchars($message);

$email = strtolower($email);
$message = strtolower($message);
$status = 'pending';

$sql = "INSERT INTO messages (email, message, status) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $email, $message, $status);

if ($stmt->execute()) {

    $_SESSION['contact_msg'] =  "<div class='alert alert-success m-2' role='alert'> Mensagem enviada com sucesso, entraremos em contato em breve.</div>";
    header('location: ../../contact.php');
} else {

    $_SESSION['contact_msg'] =  "<div class='alert alert-danger m-2' role='alert'> Erro ao enviar mensagem, enviar no email </div>";
    header('location: ../../contact.php');
}

$conn->close();
