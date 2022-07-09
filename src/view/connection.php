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

$env_file = realpath(dirname(__FILE__, 3) . '/env.ini');
$env = parse_ini_file($env_file);


function newConnection($env = "")
{

    $banco = $env['DATABASE'];
    $servidor = $env['DATA_BASE_SERVER'];
    $usuario = $env['DATA_BASE_USER'];
    $senha = $env['DATA_BASE_PASSWORD'];


    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die('Erro: ' . $conn->connect_error);
    }

    return $conn;
}
