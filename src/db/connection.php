<?php

class Connection
{
    public static function newConnection()
    {
        $envPath = realpath(dirname(__FILE__) . '/../../env.ini');
        $env = parse_ini_file($envPath);

        // $banco = $env['DATABASE'];
        // $servidor = $env['DATA_BASE_SERVER'];
        // $usuario = $env['DATA_BASE_USER'];
        // $senha = $env['DATA_BASE_PASSWORD'];

        // $conn = new mysqli($servidor, $usuario, $senha, $banco);

        // if ($conn->connect_error) {
        //     die('Erro: ' . $conn->connect_error);
        // }

        return $env;
    }
}

