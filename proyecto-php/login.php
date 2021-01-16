<?php

    if(isset($_POST))
    {
        //iniciar sesión y la conexión a la bd
        require_once "includes/conexion.php";

        //Recoger datos del formulario
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db, trim($_POST['password'])) : false;
        
        //Consulta para comprobar credenciales del usuario
        $sql = "SELECT * FROM usuarios where email = '$email' LIMIT 1";
        $query = mysqli_query($db, $sql);

        if($query && mysqli_num_rows($query) == 1)
        {
            $usuario = mysqli_fetch_assoc($query);;

            if(password_verify($password, $usuario['password']))
            {
                $_SESSION['usuario'] = $usuario;

                if(isset($_SESSION['error_login']))
                {
                    unset($_SESSION['error_login']);
                }
            }
            else
            {
                $_SESSION['error_login'] = "Las contraseña es incorrecta";
            }
        }
        else
        {
            $_SESSION['error_login'] = "Las credenciales son incorrectas";
        }
    }

    //Redirigir al index.php
    header("Location: index.php");
?>