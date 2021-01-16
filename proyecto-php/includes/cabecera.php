<?php require_once "conexion.php";?>
<?php require_once "includes/helpers.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header id="cabecera">
        <div id="logo">
            <a href="index.php">Blog de Videojuegos</a>
        </div>
        <nav id="menu">
            
            <ul>
                <li><a href="index.php">Inicio</a></li>

                <?php 
                
                    $categorias = listarCategorias($db);
                    if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)): ?>
                        <li><a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a></li>

                <?php endwhile; endif; ?>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>

    <main>
    <section id="contenedor">