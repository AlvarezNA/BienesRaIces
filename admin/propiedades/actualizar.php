<?php
use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
require '../../includes/app.php';
estaAutenticado();

   $id = $_GET['id'];
   $id = filter_var($id, FILTER_VALIDATE_INT);

   if(!$id) {
       header('Location: /admin');
   }
// mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//obtener los datos de la propiedad

$propiedad = Propiedad::find($id);

$vendedores = Vendedor::all();

  //arreglo con mensajes de error

    $errores = Propiedad::getErrores();

  //ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $args = $_POST['propiedad'];
      
        $propiedad->sincronizar($args);
      
           $errores = $propiedad->validar();

           //SUBIDA DE ARCHIVOS

           $nombreImagen = md5(uniqid( rand(), true ) ) . ".jpg";

           if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
               
        }
                if(empty($errores)) {
                    if($_FILES['propiedad']['tmp_name']['imagen']) {
                 //almacenar la imagen 
                 $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
          $propiedad->guardar();     
 }

        }                                     
    incluirTemplate('header');   
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/admin" class="boton boton-verde" >Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta de error">
            <?php echo $error; ?>   
        </div>

        <?php endforeach;  ?>

        <form class="formulario" method="POST"  enctype="multipart/form-data">
        
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
        </form>
    </main>
    
    <?php
   
    
   incluirTemplate('footer');
    
?>

<?php

    require '../../includes/funciones.php';
    
    incluirTemplate('header');
    
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>
    </main>


    
    
    <?php
   
    
   incluirTemplate('footer');
    
?>