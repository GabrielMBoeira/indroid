<?php

//RETORNANDO EMAIL DO USUARIO DA BASE DE DADOS
function getEmail($email)
{

    $conn = newConnection();

    $sql = "SELECT email FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $row = null;
    }

    return $row;

    $conn->close();
}

function getUser($id = "", $email = "")
{
    $conn = newConnection();

    // $sql = "SELECT * FROM users WHERE email = ?";

    $sql = "SELECT * FROM users WHERE ";

    if ($id != "") {
        $sql .= 'id = ?';
    }

    if ($email != "") {
        $sql .= 'email = ?';
    }

    if ($id && $email) {
        $sql .= 'id = ? and email = ?';
    }

    $stmt = $conn->prepare($sql);

    if ($id) {
        $stmt->bind_param('i', $id);
    }

    if ($email) {
        $stmt->bind_param('s', $email);
    }
    
    if ($id && $email) {
        $stmt->bind_param('is', $id, $email);
    }


    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $row = null;
    }

    return $row;

    $conn->close();
}


//RETORNANDO ID DO USUARIO DA BASE DE DADOS
function getIdUser($email)
{

    $conn = newConnection();

    $sql = "SELECT id FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['id'];
    } else {
        $userID = null;
    }

    return $userID;

    $conn->close();
}

//VALIDANDO SE EMAIL E PASSWORD ESTÃO CORRETOS
function checkPassword($email, $password)
{
    $conn = newConnection();

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            $data = $row;
        } else {

            $data = null;
        }
    } else {
        $data = null;
    }

    return $data;
}


//VALIDANDO SE EMAIL E PASSWORD ESTÃO CORRETOS
function confirmPassUser($userID, $pass_current)
{

    $conn = newConnection();

    $sql = "SELECT * FROM users WHERE id = ? AND password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $userID, $pass_current);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $dt = true;
    } else {
        $dt = false;
    }

    return $dt;
}


function passwordComparison($password, $confirm_password)
{
    $password === $confirm_password ? $valid = true : $valid = false;
    return $valid;
}



//ALTERAR PASSWORD
function alterPassword($userID, $password)
{
    $conn = newConnection();

    $sql = "UPDATE users SET password = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $password, $userID);

    if ($stmt->execute()) {
        return true;
    } else {
        return null;
    }
}


//VALIDANDO SE USUÁRIO ESTÁ ATIVO
function userIsActive($email)
{
    $conn = newConnection();

    $sql = "SELECT status FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $row = null;
    }

    return $row;
}

function existEmail($email)
{
    $conn = newConnection();

    $sql = "SELECT email FROM users WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows >= 0) {
        $dados = $result->fetch_assoc();
    } else {
        $dados = null;
    }

    return $dados;

    $conn->close();
}


//GERAR CHAVE DE ACESSO PARA RECUPERAÇÃO DE SENHA
function newKeyAccess($email)
{
    $conn = newConnection();

    $sql = "SELECT id, email FROM users WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();

        $key = sha1($dados['id'] . $dados['email']);
    }

    return $key;

    $conn->close();
}

//CHECK KEY
function checkKey($email, $hash)
{
    $conn = newConnection();

    $sql = "SELECT id, email, password FROM users WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows >= 0) {
        $dados = $result->fetch_assoc();

        $correctKey = sha1($dados['id'] . $dados['email']);

        if ($hash === $correctKey) {
            $check = true;
        } else {
            $check = false;
            echo 'invalid hash ';
        }

        return $check;
    } else {
        $dados = null;
    }

    $conn->close();
}


//PEGA O EMAIL POR ID
function getEmailById($id)
{
    $conn = newConnection();

    $sql = "SELECT email FROM users WHERE id = '$id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();
    } else {
        $dados = null;
    }

    return $dados;

    $conn->close();
}

//PEGA O IP DE ACESSO
function getAccessIP()
{
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

function setQtdAccessUser($id, $user_qtd_access) {

    $conn = newConnection();

    $qtd = $user_qtd_access + 1;

    $sql = "UPDATE users SET qtd_access = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $qtd, $id);

    if (!$stmt->execute()) {
        echo "Erro ao acessar o sistema, envie uma mensagem para o adminstrador do sistema!";       
    }

    $conn->close();

}