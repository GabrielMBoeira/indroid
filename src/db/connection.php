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
// Produção
// -------------------------------------------------------------------------

$env_file = realpath(dirname(__FILE__, 3) . '/env.ini');
$env = parse_ini_file($env_file);

function newConnection($env)
{

    // // $banco = 'heroku_3628a341b2734f7';
    // // $servidor = 'us-cdbr-east-06.cleardb.net';
    // // $usuario = 'bb454cdf637e83';
    // // $senha = '2bb72566';

    // var_dump($env['DATABASE']).'<br>';
    // var_dump($env['DATA_BASE_SERVER']).'<br>';
    // var_dump($env['DATA_BASE_USER']).'<br>';
    // var_dump($env['DATA_BASE_PASSWORD']).'<br>';
    // die;

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
