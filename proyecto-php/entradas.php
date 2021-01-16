<?php require_once "includes/cabecera.php"?>
<?php require_once "includes/lateral.php"?>

<section id="principal">
    <h1>Todas las entradas</h1>
    <?php 
        $entradas = listarEntradas($db);
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
        <div class="alerta">No hay entradas por el momento</div>
    <?php endif; ?>

    <div id="ver-todas"><a href="index.php">Ver menos</a></div>
</section>
<?php require_once "includes/pie.php"?>