<aside id="sidebar">


    <div id="buscador" class="bloque">
        <h2>Buscar</h2>

        <form action="buscar.php" method="POST">
            <input type="text" id="busqueda" name="busqueda"/>
            <input type="submit" name="entrar" value="Buscar"/>
        </form>
    </div>

    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario-logueado" class="bloque">
            <h2>Bienvenido, <?=$_SESSION['usuario']['nombre']. ' '.$_SESSION['usuario']['apellidos']?></h2>
            <!-- Botones-->
            <a href="mis_entradas.php" class="boton boton-morado">Mis Entradas</a>
            <a href="crear_entradas.php" class="boton boton-verde">Crear Entradas</a>
            <a href="crear_categoria.php" class="boton">Crear Categorías</a>
            <a href="mis_datos.php" class="boton boton-naranja">Mis Datos</a>
            <a href="cerrar_sesion.php" class="boton boton-rojo">Cerrar Sesion</a>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['usuario'])): ?>
        <div id="login" class="bloque">
            <h2>Identificate</h2>

            <?php echo isset($_SESSION['error_login']) ? mostrarError($_SESSION, 'error_login') : ''; ?>

            <form action="login.php" method="POST">
                <label for="email_log">Email</label>
                <input type="email" id="email_log" name="email"/>

                <label for="password_log">Contraseña</label>
                <input type="password" id="password_log" name="password"/>

                <input type="submit" name="entrar" value="Entrar"/>
            </form>
        </div>

        <div id="register" class="bloque">

            <h2>Registrate</h2>

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

            <form action="registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

                <label for="email">Email</label>
                <input type="email" id="email" name="email"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>
                
                <input type="submit" name="registrar" value="Registrar"/>
            </form>
            <?php borrarErrores();?>
        </div>
    <?php endif; ?>
</aside>