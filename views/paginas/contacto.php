<main class="contenedor seccion ">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="webp">
        <source srcset="build/img/destacada3.jpg" type="jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen destacada">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <?php if($mensaje) { ;?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php }; ?>

    <form class="formulario contenido-centrado-form" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o compra:</label>
            <select id="opciones" name="contacto[tipo]">
                <option selected disabled>-Seleccione-</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <label for="presupuesto">Precio | Presupuesto:</label>
            <input type="number" min="0" placeholder="$" id="presupuesto" name="contacto[precio]">
        </fieldset>

        <fieldset>
            <legend>Forma de Contacto</legend>

            <div class="forma-contacto">
                <!-- con el name contacto agrupamos y se puede seleccionar solo uno -->
                <label for="conactar-telefono">Telefono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]">

                <label for="conactar-email">Email</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]">
            </div>

            <div id="contacto"></div>

        </fieldset>

        <input class="boton-verde" type="submit" value="Enviar"> 
    </form>

    </main>