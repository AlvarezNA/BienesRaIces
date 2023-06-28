<?php
 function conectarDB() : mysqli {
    $DB_HOST = getenv('DB_HOST'); 
    $DB_USER= getenv('DB_USER');
    $DB_PASSWORD= getenv('DB_PASSWORD');
    $DB_NAME= getenv('DB_NAME');
    $DB_PORT = getenv('DB_PORT');

    $db = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);
    $db->set_charset('utf8');
    
    if ($db->connect_errno) {
        echo "Error: No se pudo conectar a la base de datos";
        exit;
    }
    
    return $db;
}
