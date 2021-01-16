<?php require_once "includes/redireccion.php"?>
<?php require_once "includes/cabecera.php"?>
<?php require_once "includes/lateral.php"?>

<section id="principal">
    <h1>Crear Categorias</h1>
    <p>Añade nuevas categorías al blog, para que los usuarios puedan usaralas al crear sus entradas.</p>
    <br/>
    <form action="guardar_categoria.php" method="POST">
        
        <?php
            if (isset($_SESSION['completado']))
            {
                echo "<div class='alerta alerta-exito'>".$_SESSION['completado']."</div>";
            }
            else if(isset($_SESSION['errores']['general']))
            {
                echo "<div class='alerta alerta-error'>".$_SESSION['errores']['general']."</div>";
            }
        ?>

        <label for="nombre">Nombre de la categoria</label>
        <input type="text" id="nombre" name="nombre">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?> 
        <input type="submit" value="Guardar">
    </form>
        <?php borrarErrores(); ?>
</section>

<?php require_once "includes/pie.php"?>