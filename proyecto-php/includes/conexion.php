<?php
    $servidor = "localhost";
    $usuario = "root";
    $contrasenia = "Daniel100";
    $base_de_datos = "blog-php-mysql";
    $db = mysqli_connect($servidor, $usuario, $contrasenia, $base_de_datos);

    mysqli_query($db, "Set NAMES 'utf8'");

    //iniciar la sesión

    if(!isset($_SESSION))
    {
        session_start();
    }
?>