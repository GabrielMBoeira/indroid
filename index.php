<?php

$url = (isset($_GET['url']) ? $_GET['url'] : 'home');
$url = array_filter(explode('/', $url)); 

$file_url = $url[0].'.php';
$file_path = 'src/view/'.$file_url;

var_dump($file_path);

if (is_file($file_path)) {
    require_once($file_path);
} else {
    require_once('src/view/404.php');
}

