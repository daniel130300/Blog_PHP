<?php require_once "includes/redireccion.php"?>
<?php require_once "includes/cabecera.php"?>
<?php require_once "includes/lateral.php"?>

<section id="principal">

    <h1>Mis Datos</h1>
    <br/>
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

    <form action="actualizar_usuario.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?=$_SESSION['usuario']['nombre']?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" value="<?=$_SESSION['usuario']['apellidos']?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?=$_SESSION['usuario']['email']?>"/>
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>
        
        <input type="submit" name="registrar" value="Actualizar"/>
    </form>
    
    <?php borrarErrores();?>
</section>

<?php require_once "includes/pie.php"?>