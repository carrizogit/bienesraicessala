<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen destacada">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>

        <p><?php echo $propiedad->descripcion; ?></p>

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
                    <p><?php echo $propiedad->estacionamiento;?></p>
                </div>
            </div>
    </div>
</main>