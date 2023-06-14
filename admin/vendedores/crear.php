<?php

require '../../includes/app.php';
use App\Vendedor;


estaAutenticado(); 

$vendedor = new Vendedor;

  //arreglo con mensajes de error
  $errores = Vendedor::getErrores();

   //ejecutar el codigo despues de que el usuario envia el formulario
   if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Crear una nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        //validar que no hay campos vacios
       $errores =  $vendedor->validar();

       //no hay errores
       if(empty($errores)) {
        $vendedor->guardar();
       }
   }
   incluirTemplate('header');  
   ?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>
        <a href="/admin" class="boton boton-verde" >Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta de error">
            <?php echo $error; ?>   
        </div>

        <?php endforeach;  ?>

        <form class="formulario" method="POST">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
       
        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>
    
    <?php
   
    
   incluirTemplate('footer');
    
?>