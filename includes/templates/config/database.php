<?php
 function conectarDB() : mysqli {
    $url = getenv('RAILWAY_URL');
    $dbname = getenv('RAILWAY_DATABASE');
    $username = getenv('RAILWAY_USERNAME');
    $password = getenv('RAILWAY_PASSWORD');

    $db = new mysqli($url, $username, $password, $dbname);
    $db->set_charset('utf8');
    
    if ($db->connect_errno) {
        echo "Error: No se pudo conectar a la base de datos";
        exit;
    }
    
    return $db;
}
