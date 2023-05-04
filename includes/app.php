<?php 
require 'funciones.php';
require 'templates/config/database.php';
require __DIR__ . '/../vendor/autoload.php';
//connectarse a la base de datos 

$db = conectarDB();
use App\ActiveRecord;

ActiveRecord::setDB($db);

