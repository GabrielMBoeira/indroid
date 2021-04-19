<?php

//RETORNANDO EMAIL DO USUARIO DA BASE DE DADOS
function getEmail($email)
{

    $conn = newConnection();

    $sql = "SELECT * FROM login WHERE email = ?";

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


//RETORNANDO ID DO USUARIO DA BASE DE DADOS
function getIdUser($email)
{

    $userID = null;

    $conn = newConnection();

    $sql = "SELECT id_user FROM login WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['id_user'];
    } else {
        $userID = null;
    }

    return $userID;
}

//VALIDANDO SE EMAIL E PASSWORD ESTÃO CORRETOS
function checkPassword($email, $password)
{

    $conn = newConnection();

    $sql = "SELECT * FROM login WHERE email = ? AND password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $row = null;
    }

    return $row;
}


//VALIDANDO SE EMAIL E PASSWORD ESTÃO CORRETOS
function confirmPassUser($userID, $pass_current)
{

    $conn = newConnection();

    $sql = "SELECT * FROM login WHERE id_user = ? AND password = ?";

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

    $sql = "UPDATE login SET password = ? WHERE id_user = ?";

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

    $sql = "SELECT status FROM login WHERE email = ?";

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

    $sql = "SELECT email FROM login WHERE email = '$email'";

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

    $sql = "SELECT id_user, password FROM login WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();

        $key = sha1($dados['id_user'] . $dados['password']);
    }
    return $key;

    $conn->close();
}

//CHECK KEY
function checkKey($email, $hash)
{

    $conn = newConnection();

    $sql = "SELECT id_user, email, password FROM login WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows >= 0) {
        $dados = $result->fetch_assoc();

        $correctKey = sha1($dados['id_user'] . $dados['password']);

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
