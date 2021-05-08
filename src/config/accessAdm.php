<?php


function accessAdm($email, $password)
{
    //Redirecionando caso seja administrador
    if ($email === "admin@gmail.com" && $password === 'admin') {
        header('location: ../../users');
        die();
    } 
}
