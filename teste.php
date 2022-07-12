<?php

require_once('connection.php');

$env_file = realpath(dirname(__FILE__) . '/env.ini');
$env = parse_ini_file($env_file);

$conn = newConnection($env);

$teste = 'gabriel';

$sql = "INSERT INTO teste (nome) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $teste);
$stmt->execute();

