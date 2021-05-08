<?php


function accessAdm($email, $password)
{
    //REDIRECIONANDO CASO SEJA LOGIN ADMINISTRADOR
    if ($email === "admin@gmail.com" && $password === 'admin') {
        header('location: ../../users');
        die();
    }
}
