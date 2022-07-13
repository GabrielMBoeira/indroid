<?php
class Connection
{   
    public static function newConnection()
    {
        // $envPath = realpath(dirname(__FILE__) . '/../../env.ini');
        // $env = parse_ini_file($envPath);

        $banco = 'heroku_b1051811368e69b';
        $servidor = 'us-cdbr-east-06.cleardb.net';
        $usuario = 'b8f8fc3ebcea22';
        $senha = '57275722';

        $conn = new mysqli($servidor, $usuario, $senha, $banco);

        if ($conn->connect_error) {
            die('Erro: ' . $conn->connect_error);
        }

        return $conn;
    }
}
