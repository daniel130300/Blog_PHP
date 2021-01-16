<?php
    if(isset($_POST))
    {
        //Conexion a la base de datos
        require_once "includes/conexion.php";

        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;
        $apellidos = isset($_POST['apellidos']) ?mysqli_real_escape_string($db, trim($_POST['apellidos'])) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
        $usuario = (int)$_SESSION['usuario']['id'];

        $errores = array();

        //Validar los datos antes de guardarlos en la base de datos
    
        //Validar el nombre
        if($nombre!=false && is_string($nombre) && preg_match("/[A-Za-z ]/",$nombre))
        {
            $nombre_validado = true;
        }
        else
        {
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es valido";
        }
    
        //Validar los apellidos
        if($apellidos!=false && is_string($apellidos) && preg_match("/[A-Za-z ]/",$apellidos))
        {
            $apellidos_validado = true;
        }
        else
        {
            $apellidos_validado = false;
            $errores['apellidos'] = "Los apellidos no son validos";
        }
    
        //Validar el email
        if($email!=false && is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $email_validado = true;
        }
        else
        {
            $email_validado = false;
            $errores['email'] = "El email no es valido";
        }
    
        if(count($errores)==0)
        {
            //actualizar usuario en la bdd

            $sql_email = "SELECT id, email FROM usuarios WHERE email = '$email'";

            $isset_email = mysqli_query($db, $sql_email);
            $isset_user = mysqli_fetch_assoc($isset_email);

            if($usuario == $isset_user['id'] || empty($isset_user))
            {
                //Insertar usuario en la tabla de usuarios en la bdd
                $sql = "UPDATE USUARIOS SET nombre = '$nombre', apellidos='$apellidos', email='$email' WHERE id = $usuario;";
                $query = mysqli_query($db, $sql);

                if($query)
                {
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellidos'] = $apellidos;
                    $_SESSION['usuario']['email'] = $email;

                    $_SESSION['completado'] = "Tus datos han sido actualizados";
                }
                else
                {
                    $_SESSION['errores']['general'] = "Fallo al actualizar tus datos";
                }
            }
            else
            {
                $_SESSION['errores']['general'] = "El correo ingresado ya existe";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }
    
    header("Location: mis_datos.php");
?>