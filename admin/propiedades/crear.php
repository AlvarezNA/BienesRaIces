<?php
require '../../includes/app.php';

use App\Propiedad; 
use Intervention\Image\ImageManagerStatic as Image;


estaAutenticado(); 

 $db = conectarDB();
// mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// base de datos

//consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores"; 
    $resultado = mysqli_query($db, $consulta);

  //arreglo con mensajes de error
    $errores =Propiedad::getErrores();
    
    $titulo = '';
    $precio = '';
    $descripcion =''; 
    $habitaciones = '';
    $wc = '';
    $estacionamiento =''; 
    $vendedores_id ='';

  //ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

     $propiedad = new Propiedad($_POST);
  //crear carpeta

     //generar nombre unico
     $nombreImagen = md5(uniqid(rand(), true )) . ".jpg";

     if($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
     }
     //validar
    $errores = $propiedad->validar();
    if(empty($errores)) {
      
     
     //crear la carpet para subir imagenes 
     if(!is_dir(CARPETA_IMAGENES)) {
        mkdir(CARPETA_IMAGENES);
     }
                        //Guardar la imagen en el servidor
                        $image->save(CARPETA_IMAGENES . $nombreImagen);

                     $resultado = $propiedad->guardar();    
                        //MENSAJE DE EXITO

       if($resultado) {
        //Redireccionar al usuario 
    header('Location: /admin?resultado=1');
}


        }
                    

              


                  }
    
    incluirTemplate('header');
    
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde" >Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta de error">
            <?php echo $error; ?>   
        </div>

        <?php endforeach;  ?>




        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        
        <fieldset>

            <legend>Informacion general</legend>
            <label for="titulo">titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="titulo propiedad" value="<?php echo $titulo;?>">

            <label for="precio"> precio:</label>
            <input type="number" id="precio" name="precio" placeholder="precio propiedad" value="<?php echo $precio;?>">

            <label for="imagen">imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name= "imagen">
            <label for= "descripcion">descripcion:</label>
            <textarea id="descripcion"name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>  
        <legend>Informacion Propiedad</legend>
        <label for="habitaciones"> habitaciones:</label>
            <input type="number" id="habitaciones" name= "habitaciones" placeholder="Ejem: 3" min="1" max="9" value="<?php echo $habitaciones;?>">
            <label for="wc"> baños:</label>
            <input type="number" id="wc" name ="wc" placeholder="Ejem: 3" min="1" max="9"  value="<?php echo $wc;?>">
            <label for="estacionamiento"> estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejem: 3" min="1" max="9"   value="<?php echo $estacionamiento;?>">
        </fieldset>
        <fieldset>
        <legend>vendedor</legend>   
        <select name ="vendedores_id">
        <option value="">--Seleccione--</option>
           <?php while($vendedor = mysqli_fetch_assoc($resultado) ): ?>
            
            <option <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['id']; ?>"> 
            <?php  echo $vendedor['nombre'] . " " . $vendedor ['apellido']; ?> </option>
            
            <?php endwhile; ?>

           </select>
        </fieldset>
        <input type="submit" value="crear Propiedad" class="boton boton-verde">
        </form>
    </main>
    
    <?php
   
    
   incluirTemplate('footer');
    
?>