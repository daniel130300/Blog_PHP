<?php require_once "includes/redireccion.php"?>
<?php require_once "includes/cabecera.php"?>

<?php
    $entrada = listarEntrada($db, $_GET['id']);

    if(!isset($entrada['id']))
    {
        header("Location:index.php");
    }
?>

<?php require_once "includes/lateral.php"?>

<section id="principal">
    <h1>Editar Entrada</h1>
    <p>Edita tu entrada</p>
    <br/>
    <form action="guardar_entrada.php?editar=<?=$entrada['id']?>" method="POST">
        
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
        <input type="text" id="titulo" name="titulo" value="<?=$entrada['titulo']?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'titulo') : ''; ?>

        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion"><?=$entrada['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion') : ''; ?>


        <label for="categoria">Categoria</label>
        <select id="categoria" name="categoria">
            <?php
                $categorias = listarCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada['categoria_id']) ? 'selected = "selected"' : ''?>>
                <?=$categoria['nombre']?></option>
            <?php endwhile; endif;?> 
        </select>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : ''; ?>
        <input type="submit" value="Guardar">
    </form>
        <?php borrarErrores(); ?>
</section>

<?php require_once "includes/pie.php"?>