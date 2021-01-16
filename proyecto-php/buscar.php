<?php require_once "includes/cabecera.php"?>
<?php
    if(!isset($_POST['busqueda']))
    {
        header("Location:index.php");
    }
?>

<?php require_once "includes/lateral.php"?>

    
<section id="principal">

    <h1>Busqueda: <?=$_POST['busqueda']?></h1>
    <?php 
        $entradas = listarEntradas($db, null, null, $_POST['busqueda']);
        if(!empty($entradas) && mysqli_num_rows($entradas)>=1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>  
        <article class="entrada">
            <a href="entrada.php?id=<?=$entrada['id']?>">
                <h2><?=$entrada['titulo']?></h2>
                <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                <p><?=substr($entrada['descripcion'], 0 ,180)?>...</p>
            </a>
        </article>
    <?php   
            endwhile; 
        else:
    ?>
        <br/>
        <div class="alerta alerta-error">No se encontraron resultados relacionados a esta búsqueda</div>
    <?php endif; ?>
</section>
<?php require_once "includes/pie.php"?>
   
