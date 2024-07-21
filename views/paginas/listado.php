<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad ) : ?>

        <div class="anuncio">
            <img class="img-fijo" loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen 1">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p class="descripcion-fija"><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>
                <div class="iconos-nuevos">
                    <div class="iconos-campo">
                        <img src="build/img/icono_dormitorio.svg" alt="domitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </div>
                    <div class="iconos-campo">
                        <img src="build/img/icono_wc.svg" alt="domitorio">
                        <p><?php echo $propiedad->wc; ?></p>
                    </div>
                    <div class="iconos-campo">
                        <img src="build/img/icono_estacionamiento.svg" alt="domitorio">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </div>
                </div>


                <a class="boton-amarillo-block" href="/propiedad?id=<?php echo $propiedad->id; ?>">Ver Propiedad</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>