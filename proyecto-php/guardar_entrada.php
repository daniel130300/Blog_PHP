<?php
    if(isset($_POST))
    {
        require_once "includes/conexion.php";

        $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, trim($_POST['titulo'])) : false;
        $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, trim($_POST['descripcion'])) : false;
        $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
        $usuario = (int)$_SESSION['usuario']['id'];

        $errores = array();

        if(empty($titulo))
        {
            $errores['titulo'] = "El titulo no es valido.";
        }

        if(empty($descripcion))
        {
            $errores['descripcion'] = "La descripcion no es valida.";
        }

        if(empty($categoria) && !is_int($categoria))
        {
            $errores['categoria'] = "La categoría seleccionada no es valida.";
        }


        if(count($errores)==0)
        {
            if(isset($_GET['editar']))
            {
                $entrada_id = $_GET['editar'];
                //editar entrada en la bdd
                $sql = "UPDATE ENTRADAS SET titulo = '$titulo', descripcion = '$descripcion', categoria_id = $categoria ". 
                "WHERE id = $entrada_id AND usuario_id = $usuario";
                $location = "editar_entrada.php?id=$entrada_id";
            }
            else
            {
                //insertar entrada en la bdd
                $sql = "INSERT INTO ENTRADAS VALUES (null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
                $location = "crear_entradas.php";
            }

            $query = mysqli_query($db, $sql);

            if($query)
            {
                $_SESSION['completado'] = "La entrada se ha guardado con exito";
            }
            else
            {
                $_SESSION['errores']['general'] = "Fallo al guardar la entrada";
            }
        }
        else
        {
            $_SESSION['errores'] = $errores;
        }
    }
    header("Location: $location");
?>