<main class="contenedor seccion">
    <h1>Agregar Nuevo Vendedor</h1>

    <a class="boton-amarillo" href="/admin">Atras</a>

    <?php foreach($errores as $error) {; ?>
        <div class="alerta error contenido-centrado-form">
            <?php echo $error; ?>
        </div>
    <?php }; ?>

    <form class="formulario contenido-centrado-form" method="POST" action="/vendedores/crear">
        
        <?php include 'formulario.php'; ?>

        <input class="boton-verde" type="submit" value="Guardar">
    </form>
</main>