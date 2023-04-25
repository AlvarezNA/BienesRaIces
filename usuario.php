<?php 
//importar la conexion

require 'includes/app.php';
    $db = conectarDB();


//crear un email y pasword
$email = "correo@correo.com";
$password = "123456";


$passwordHash = password_hash($password, PASSWORD_BCRYPT);



//query para crear el usuario
$query = " INSERT INTO bienesraices_crud.usuarios (email, password) VALUES ( '${email}', '${passwordHash}'); ";

//echo $query;
 
mysqli_query($db, $query);