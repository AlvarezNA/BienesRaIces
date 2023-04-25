<?php
require '../../includes/funciones.php';

$auth = estaAutenticado(); 

if(!$auth) {
 header('Location: /');
}

   //validar la url por id valido
   $id = $_GET['id'];
   $id = filter_var($id, FILTER_VALIDATE_INT);

   if(!$id) {
       header('Location: /admin');
   }
// mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// base de datos

require '../../includes/templates/config/database.php';   
$db = conectarDB();


//obtener los datos de la propiedad

$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores"; 
    $resultado = mysqli_query($db, $consulta);

  //arreglo con mensajes de error

    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio =  $propiedad['precio'];
    $descripcion = $propiedad['descripcion']; 
    $habitaciones = $propiedad['habitaciones'];
    $wc =  $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento']; 
    $vendedores_id = $propiedad['vendedores_id'];
    $imagenPropiedad = $propiedad ['imagen'];

  //ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      
    
       //  echo "<pre>";
    //  var_dump($_POST);
      //  echo "</pre>";

        
      //  echo "<pre>";
      //  var_dump($_FILES);
       //   echo "</pre>";
      
                $titulo = mysqli_real_escape_string( $db,  $_POST['titulo'] );
                $precio = mysqli_real_escape_string( $db,  $_POST['precio'] );
                $descripcion = mysqli_real_escape_string( $db,  $_POST['descripcion'] );
                $habitaciones = mysqli_real_escape_string( $db,  $_POST['habitaciones'] );
                $wc = mysqli_real_escape_string( $db,  $_POST['wc']);
                $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
                $vendedores_id = mysqli_real_escape_string( $db, $_POST['vendedor'] );
                $creado = date('Y/m/d');


                //asignar files hacia una variable
               $imagen = $_FILES ['imagen'];
               
               

                if(!$titulo)    {   
                    $errores [] = "debes añadir un titulo";
}

                if(!$precio){
                    $errores[]= "el precio es obligatorio";
                }

                if(strlen($descripcion)< 50 ){
                    $errores[]= "la descripcion es obligatoria y debe tener almenos 50 caracteres";
                }
                if(!$habitaciones){
                    $errores[]= "las habitaciones son obligatorias";
                }
                if(!$wc){
                    $errores[]= "el numero de wc es obligatorio";
                }
                if(!$estacionamiento){
                    $errores[]= "el numero de estacionamientos es obligatorio";
                }
                if(!$vendedores_id){
                    $errores[]= "elije un vendedor";
                }
               

                //validar por tamaños (100kb maximos)
                $medida = 1000 * 1000 ;

                if ($imagen['size'] > $medida ) {
                    $errores []='la imagen es muy pesada';
                }


            

             // echo "<pre>";
           //  var_dump($errores);
           //    echo "</pre>";
           
                    if(empty($errores)) {
                    
                    $carpetaImagenes = '../../imagenes/';
                    if (!is_dir($carpetaImagenes)){
                       mkdir($carpetaImagenes);
                }

                        //subida de archivos

                        //crear carpeta
                    if($imagen['name']) {
                      unlink($carpetaImagenes . $propiedad['imagen']);

                     
                        //generar nombre unico

                        $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";
                
                       //subir la imagen

                      move_uploaded_file($imagen['tmp_name'] , $carpetaImagenes . $nombreImagen  );

                    } else {
                        $nombreImagen = $propiedad ['imagen']; 
                    }
                  
                       
                        $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, 
                        wc = ${wc}, estacionamiento = ${estacionamiento}, vendedores_id = ${vendedores_id} WHERE id = ${id} ";


                       // echo $query;
                       
                      }
       
       $resultado = mysqli_query($db, $query);     
       if($resultado) {
        //Redireccionar al usuario 
    header('Location: /admin?resultado=2');
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
        
        <fieldset>

            <legend>Informacion general</legend>
            <label for="titulo">titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="titulo propiedad" value="<?php echo $titulo;?>">

            <label for="precio"> precio:</label>
            <input type="number" id="precio" name="precio" placeholder="precio propiedad" value="<?php echo $precio;?>">

            <label for="imagen">imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name= "imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

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
        <select name ="vendedor">
        <option value="">--Seleccione--</option>
           <?php while($vendedor = mysqli_fetch_assoc($resultado) ): ?>
            
            <option <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor ['id']; ?>"> 
            <?php  echo $vendedor['nombre'] . " " . $vendedor ['apellido']; ?> </option>
            
            <?php endwhile; ?>

           </select>
        </fieldset>
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