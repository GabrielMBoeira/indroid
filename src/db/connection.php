<?php

function newConnection($banco = 'indroid') {
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if($conn->connect_error) {
        die('Erro: ' . $conn->connect_error);
    }

    return $conn;
}


// -------------------------------------------------------------------------
// PRODUÇÃO
// -------------------------------------------------------------------------

// function newConnection($banco = 'indroid') {
//     $servidor = 'indroid.cj69zfae2few.us-east-1.rds.amazonaws.com';
//     $usuario = 'indroid';
//     $senha = 'CHAngeme1*';

//     $conn = new mysqli($servidor, $usuario, $senha, $banco);

//     if($conn->connect_error) {
//         die('Erro: ' . $conn->connect_error);
//     }

//     return $conn;
// }