<?php require_once "includes/redireccion.php"?>
<?php require_once "includes/cabecera.php"?>
<?php require_once "includes/lateral.php"?>

<section id="principal">
    <h1>Crear Entradas</h1>
    <p>Añade nuevas entradas al blog, para que los usuarios puedan 
    leerlas y disfrutar de nuestro contenido.</p>
    <br/>
    <form action="guardar_entrada.php" method="POST">
        
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

        <label for="titulo">Titulo</label>
        <input type="text" id="titulo" name="titulo">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'titulo') : ''; ?>

        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion') : ''; ?>


        <label for="categoria">Categoria</label>
        <select id="categoria" name="categoria">
            <?php
                $categorias = listarCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
            <?php endwhile; endif;?> 
        </select>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : ''; ?>
        <input type="submit" value="Guardar">
    </form>
        <?php borrarErrores(); ?>
</section>

<?php require_once "includes/pie.php"?>