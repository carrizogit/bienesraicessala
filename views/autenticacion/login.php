<main class="contenedor seccion">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error) : ?>
        <div class="alerta error ">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario contenido-usuario" method="POST" action="/login">
        <label for="email">Email</label>
        <input type="email" placeholder="Email" id="email" name="email" require>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Contraseña" require>

        <input type="submit" class="boton-verde" value="Iniciar Sesión">
    </form>
</main>