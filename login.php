<?php 
  require 'includes/app.php';
$db = conectarDB();

// autenticar el usuario

$errores= [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  //  echo "<pre>";
   // var_dump($_POST);
   // echo "</pre>";

    $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) );
   
    $password =  mysqli_real_escape_string($db, $_POST['password']);

    if(!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if(!$password) {
        $errores[] = "El password es obligatorio ";
    }
   if(empty($errores)) {
// revisar si el usuario existe o no
    $query = "SELECT * FROM root.usuarios WHERE email = '${email}' ";
    $resultado = mysqli_query($db, $query);




if( $resultado->num_rows ) { 
    $usuario = mysqli_fetch_assoc($resultado);
    var_dump($usuario);
    $auth = password_verify($password, $usuario['password']);
   //var_dump($auth);
 if($auth) {
    session_start();
    //llenar el arreglo de la session
    $_SESSION['usuario'] = $usuario['email'];
    $_SESSION['login'] = true;
    header('Location: /admin');
 } else {
    $errores[]= 'el password es incorrecto';
    }
        
} else  {
$errores[]= 'El Usuario No Existe';
}
   }
}

//incluye el header

    
    incluirTemplate('header');
    
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error"> 
                <?php echo $error; ?> 
            </div>
            <?php endforeach; ?> 

        <form method="POST" class="formulario" > 
        <fieldset>
                <legend>Email y Password</legend>
                <label for="email">E-mail</label>
                <input type="email"  name="email" placeholder="Tu Email" id="email" >

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Ingrese su password" id="password" >

            </fieldset>
        <input type ="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form> 
    </main>

    
    <?php
   
    
   incluirTemplate('footer');
    
?> 
