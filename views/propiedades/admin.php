<main class="contenedor seccion">
    <h1>Administrador Salta Propiedades</h1>

    <!-- el $resultado lo leemos de la url con get. intval lo convierte a entero -->
    <?php
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
      <?php }
        }
    ?>              


    <a class="boton-verde" href="propiedades/crear">Agregar Propiedad</a>
    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($propiedades as $propiedad) { ?>

                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="ima"></td>
                    <td class="acciones">
                        <form method="POST" class="w-100" action="propiedades/eliminar">
                            <input type="hidden" name="idPropiedad" value="<?php echo $propiedad->id;?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    <a class="boton-verde" href="vendedores/crear">Agregar Vendedor</a>

    <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($vendedores as $vendedor) { ?>

                    <tr>
                        <td><?php echo $vendedor->id; ?></td>
                        <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                        <td><?php echo $vendedor->telefono; ?></td>

                        <td class="acciones">
                            <form method="POST" class="w-100" action="vendedores/eliminar">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id;?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
</main>