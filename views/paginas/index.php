<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <?php include 'iconos.php'; ?>
</main>

<section class="seccion contenedor">
    <h2>Casas y Departamentos en Venta</h2>

    <?php
        include 'listado.php';            
    ?>

    <div class="alinear-derecha">
        <a class="boton-verde" href="/propiedades">Ver todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de conacto y un asesor se podrá en contacto a la brevedad</p>
    <a class="boton-amarillo-block" href="/contacto">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nustro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="/entrada">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>20/20/22</span> por: <span>Admin</span></p>
                    <p>Concejos para contruir tu casa en el techo con los mejores materiales y ahorrando dinero</p>
                </a>
            </div>

        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="/entrada">
                    <h4>Guia para decoracion de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>20/20/22</span> por: <span>Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                </a>
            </div>

        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimonial</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena aención y la casa que me ofecieron cumple con todas mis expectativas
            </blockquote>
            <p>-Diego C</p>
        </div>
    </section>
</div>