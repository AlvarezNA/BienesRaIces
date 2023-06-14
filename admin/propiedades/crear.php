<?php
require '../../includes/app.php';

use App\Propiedad; 
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


estaAutenticado(); 

 $propiedad = new Propiedad;
// mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//consulta para obtener todos los vendedores
 $vendedores = Vendedor::all();
  //arreglo con mensajes de error
    $errores = Propiedad::getErrores();
    

  //ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

     $propiedad = new Propiedad($_POST['propiedad']);
  //crear carpeta

     //generar nombre unico
     $nombreImagen = md5(uniqid(rand(), true )) . ".jpg";

     if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
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

          $propiedad->guardar();    

                
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
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
       
        <input type="submit" value="crear Propiedad" class="boton boton-verde">
        </form>
    </main>
    
    <?php
   
    
   incluirTemplate('footer');
    
?>

