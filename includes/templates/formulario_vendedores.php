<fieldset>

<legend>Informacion general</legend>
<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="vendedor[nombre]" placeholder="nombre vendedor(a)" value="<?php echo s( $vendedor->nombre );?>">

<label for="apellido">Apellido:</label>
<input type="text" id="apellido" name="vendedor[apellido]" placeholder="apellido vendedor(a)" value="<?php echo s( $vendedor->apellido);?>">

</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>
<label for="Telefono">Telefono:</label>
<input type="int" id="Telefono" name="vendedor[telefono]" placeholder="telefono vendedor(a)" value="<?php echo s( $vendedor->telefono);?>">

</fieldset>