<?php

    function mostrarError($errores, $campo)
    {
        $alerta = "";

        if(isset($errores[$campo]) && !empty($campo))
        {
            $alerta = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
        }
        return $alerta;
    }

    function borrarErrores()
    {   
        $borrado = false;

        if(isset($_SESSION['errores']))
        {
            unset($_SESSION['errores']);
            $borrado = true;
        }

        if(isset($_SESSION['completado']))
        {
            unset($_SESSION['completado']);
            $borrado = true;
        }

        if(isset($_SESSION['error_login']))
        {
            unset($_SESSION['error_login']);
            $borrado = true;
        }

        return $borrado;
    }

    function listarCategorias($conexion)
    {
        $sql = "SELECT * FROM categorias ORDER BY id ASC";
        $query = mysqli_query($conexion, $sql);
        $result = array();

        if($query && mysqli_num_rows($query)>=1)
        {
            $result = $query;
        }

        return $result;
    }

    function listarCategoria($conexion, $id)
    {
        $sql = "SELECT * FROM categorias where id = $id";
        $query = mysqli_query($conexion, $sql);
        $result = array();

        if($query && mysqli_num_rows($query)>=1)
        {
            $result = mysqli_fetch_assoc($query);
        }

        return $result;
    }

    function listarEntradas($conexion, $limit=null, $categoria=null, $busqueda=null, $id_usuario=null)
    {
        $sql = "SELECT e.*, c.nombre AS 'categoria' FROM ENTRADAS e "
        ."INNER JOIN CATEGORIAS c ON e.categoria_id = c.id ". 
        "ORDER BY e.id DESC ";         

        if($limit)
        {
            $sql .= "LIMIT 4";
        }

        if(!empty($categoria) && is_int($categoria))
        {
            $sql = "SELECT e.*, c.nombre AS 'categoria' FROM ENTRADAS e "
            ."INNER JOIN CATEGORIAS c ON e.categoria_id = c.id ". 
            "WHERE e.categoria_id = $categoria ".
            "ORDER BY e.id DESC ";  
        }

        if(!empty($busqueda))
        {
            $sql = "SELECT e.*, c.nombre AS 'categoria' FROM ENTRADAS e "
            ."INNER JOIN CATEGORIAS c ON e.categoria_id = c.id ". 
            "WHERE e.titulo LIKE '%$busqueda%'".
            "ORDER BY e.id DESC "; 
        }

        if(!empty($id_usuario))
        {
            $sql = "SELECT e.*, c.nombre AS 'categoria' FROM ENTRADAS e "
            ."INNER JOIN CATEGORIAS c ON e.categoria_id = c.id ". 
            "WHERE e.usuario_id = $id_usuario ".
            "ORDER BY e.id DESC "; 
        }

        $query = mysqli_query($conexion, $sql);
        $result = array();

        if($query && mysqli_num_rows($query)>=1)
        {
            $result = $query;
        }

        return $result;
    }

    function listarEntrada($conexion, $id)
    {
        $sql = "SELECT e.*, c.nombre as 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario FROM entradas e "     
        ."INNER JOIN categorias c ON e.categoria_id = c.id ". 
        "INNER JOIN usuarios u on e.usuario_id = u.id ".
        "WHERE e.id = $id ";

        $query = mysqli_query($conexion, $sql);
        $result = array();

        if($query && mysqli_num_rows($query)>=1)
        {
            $result = mysqli_fetch_assoc($query);
        }

        return $result;
    }
?>