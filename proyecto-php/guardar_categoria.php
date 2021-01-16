<?php

    if(isset($_POST))
    {
        require_once "includes/conexion.php";

        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;

        $errores = array();

        if($nombre!=false && is_string($nombre) && preg_match("/[A-Za-z ]/",$nombre))
        {
            $nombre_validado = true;
        }
        else
        {
            $nombre_validado = false;
            $errores['nombre'] = "La categoría no es valida.";
        }

        if(count($errores)==0)
        {
            //insertar categoria en la bdd

            //Insertar categoria en la tabla de categorias en la bdd
            $sql = "INSERT INTO CATEGORIAS VALUES (null, '$nombre');";
            $query = mysqli_query($db, $sql);

            if($query)
            {
                $_SESSION['completado'] = "La categoria se ha guardado con exito";
            }
            else
            {
                $_SESSION['errores']['general'] = "Fallo al guardar la categoria";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }

    header("Location: crear_categoria.php");
?>