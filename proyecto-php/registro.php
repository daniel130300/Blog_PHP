<?php
    if(isset($_POST))
    {
        //Conexion a la base de datos
        require_once "includes/conexion.php";

        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;
        $apellidos = isset($_POST['apellidos']) ?mysqli_real_escape_string($db, trim($_POST['apellidos'])) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db, trim($_POST['password'])) : false;

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
    
        //Validar la contraseña
        if($password!=false && is_string($password))
        {
            $password_validado = true;
        }
        else
        {
            $password_validado = false;
            $errores['password'] = "La contraseña no es valida";
        }
    
        if(count($errores)==0)
        {
            //insertar usuario en la bdd
    
            //cifrar la contraseña
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
            
            //Insertar usuario en la tabla de usuarios en la bdd
            $sql = "INSERT INTO USUARIOS VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
            $query = mysqli_query($db, $sql);

            //var_dump(mysqli_error($db));

            if($query)
            {
                $_SESSION['completado'] = "El usuario se ha guardado con exito";
            }
            else
            {
                $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }
    
    header("Location: index.php");
?>