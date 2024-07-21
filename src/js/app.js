document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkMode();
});

function darkMode() {
    //leer preferencia del sistema
    // const prefiereDark = window.matchMedia('(prefers-color-scheme: dark)');
    // if(prefiereDark.matches) {
    //     document.body.classList.add('dark-mode');
    // }else {
    //     document.body.classList.add('dark-mode');
    // }


    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    // //lo iteramos con un foreach poruqe como es un queryselectorAll no se puede agregar un click directamente
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    // 'e' es el evento que le pasamos en la funcion y podemos saber el value de cual elemento le dimos click
    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero:</label>
            <input type="tel" placeholder="Telefono" id="telefono" maxlength="10" name="contacto[telefono]" required>

            <p>Elija fecha y hora para ser contactado</p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="20:00" name="contacto[hora]">
        `;
    }else {
        contactoDiv.innerHTML = `
            <label for="email">Email:</label>
            <input type="email" placeholder="Email" id="email" name="contacto[email]" required>
        `
    }
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    }else {
        navegacion.classList.add('mostrar');
    }
}
