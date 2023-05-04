<fieldset>

<legend>Informacion general</legend>
<label for="titulo">titulo:</label>
<input type="text" id="titulo" name="propiedad[titulo]" placeholder="titulo propiedad" value="<?php echo s( $propiedad->titulo );?>">

<label for="precio"> precio:</label>
<input type="number" id="precio" name="propiedad[precio]" placeholder="precio propiedad" value="<?php echo s($propiedad->precio);?>">

<label for="imagen">imagen:</label>
<input type="file" id="imagen" accept="image/jpeg, image/png" name= "propiedad[imagen]">
<?php if($propiedad->imagen) { ?>
    <img src="/imagenes/<?php echo $propiedad ->imagen ?>" class="imagen-small">
    <?php } ?>


<label for= "descripcion">descripcion:</label>
<textarea id="descripcion"name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>
<fieldset>  
<legend>Informacion Propiedad</legend>
<label for="habitaciones"> habitaciones:</label>
<input type="number" id="habitaciones" name= "propiedad[habitaciones]" placeholder="Ejem: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones);?>">
<label for="wc"> baños:</label>
<input type="number" id="wc" name ="propiedad[wc]" placeholder="Ejem: 3" min="1" max="9"  value="<?php echo s($propiedad->wc);?>">
<label for="estacionamiento"> estacionamiento:</label>
<input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ejem: 3" min="1" max="9"   value="<?php echo s($propiedad->estacionamiento);?>">
</fieldset>
<fieldset>
<legend>vendedor</legend>  
<label for="vendedor">Vendedor</label> 
<select name="propiedad[vendedores_id]" id="vendedor">
    <option selected value="">--Seleccione--</option>
    <?php foreach($vendedores as $vendedor) { ?>
        <option 
        <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?> 
         value="<?php echo s($vendedor->id); ?>" ><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> </option>
        <?php   } ?>
    </select>
</fieldset>