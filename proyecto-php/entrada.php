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

    <h1><?=$entrada['titulo']?></h1>
    <a href="categoria.php?id=<?=$entrada['categoria_id']?>">
        <h2><?=$entrada['categoria']?></h2>
    </a>
    <h3><?=$entrada['fecha']?> | <?=$entrada['usuario']?></h3>
    <p><?=$entrada['descripcion']?></p>

    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada['usuario_id']): ?>
        <a href="editar_entrada.php?id=<?=$entrada['id']?>" class="boton">Editar Entrada</a>
        <a href="eliminar_entrada.php?id=<?=$entrada['id']?>" class="boton boton-rojo">Eliminar Entrada</a>
    <?php endif; ?>

</section>
<?php require_once "includes/pie.php"?>
   
