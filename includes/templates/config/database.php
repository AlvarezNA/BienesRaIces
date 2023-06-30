<?php
session_start();
  function conectarDB() : mysqli {
    $DB_HOST= $_ENV["DB_HOST"];
    $DB_USER= $_ENV["DB_USER"];
    $DB_PASSWORD= $_ENV["DB_PASSWORD"];
    $DB_NAME= $_ENV["DB_NAME"];
    $DB_PORT= $_ENV["DB_PORT"];

    $db =mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT,);
    $db->set_charset('utf8');
    
    if ($db->connect_errno) {
        echo "Error: No se pudo conectar a la base de datos";
        exit;
    }
    
    return $db;
}
