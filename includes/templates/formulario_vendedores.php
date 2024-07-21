<fieldset>
    <legend>Informacíon Vendedores</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        placeholder="Nombre Vendedor(a)"
        value="<?php echo s($vendedor->nombre);?>"
    >

    <label for="apellido">Apellido:</label>
    <input type="text" 
        id="apellido" 
        name="vendedor[apellido]" 
        placeholder="Apellido Vendedor(a)"
        value="<?php echo s($vendedor->apellido);?>"
    >

    <label for="telefono">Telefono:</label>
    <input type="tel" 
        id="telefono" 
        name="vendedor[telefono]" 
        placeholder="Telefono Vendedor(a)"
        value="<?php echo s($vendedor->telefono);?>"
        maxlength="10"
    >

</fieldset>