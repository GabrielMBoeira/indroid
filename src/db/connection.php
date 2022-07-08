<?php

// function newConnection($banco = 'indroid') {
//     $servidor = 'localhost';
//     $usuario = 'root';
//     $senha = '';

//     $conn = new mysqli($servidor, $usuario, $senha, $banco);

//     if($conn->connect_error) {
//         die('Erro: ' . $conn->connect_error);
//     }

//     return $conn;
// }


// -------------------------------------------------------------------------
// PRODUÇÃO
// -------------------------------------------------------------------------

function newConnection($banco = 'heroku_8158a15a8674c96') {
    $servidor = 'us-cdbr-east-06.cleardb.net';
    $usuario = 'be0146cccd6e81';
    $senha = '98cc115c';

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if($conn->connect_error) {
        die('Erro: ' . $conn->connect_error);
    }

    return $conn;
}