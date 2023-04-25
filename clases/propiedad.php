<?php
namespace App;
class Propiedad {
    //base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    //errores

    protected static $errores = []; 

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

        //definir la conexion a la base de datos
        public static function setDB($database) {
            self::$db = $database;
        }



    public function __construct ($args = [])
    {
       
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio= $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }
public function guardar() {
   // echo "guardando en la base de datos"; 
   $atributos = $this->sanitizarAtributos();


    $query  = " INSERT INTO propiedades ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' "; 
    $query .=  join("', '", array_values($atributos));
    $query .= " ') ";
   
    $resultado = self::$db->query($query);

    return $resultado;
}
//identificar y unir los atributos de la Bd
public function atributos() {
    $atributos = [];
    foreach(self::$columnasDB as $columna) {
        if($columna === 'id') continue; 
        $atributos[$columna] = $this->$columna;
    }
    return $atributos;
}
public function sanitizarAtributos() {
    $atributos = $this->atributos();
    $sanitizado = [];
    foreach($atributos as $key => $value ){
        $sanitizado[$key] = self::$db->escape_string($value);
  
    }
    return $sanitizado;
}

//subida de archivos

Public function setImagen($imagen) {
    //asignar al atributo el nombre de la imagen
    if($imagen) {
        $this->imagen = $imagen;
    }
}

//validacion
public static function getErrores() {
    return self::$errores;
}

public function validar() {
    

   
     if(!$this->titulo)    {   
        self::$errores [] = "debes añadir un titulo";
}
    if(!$this->precio){
    self::$errores[] = 'el precio es obligatorio';
}   
    if(strlen($this->descripcion) < 50) {
    self:: $errores[] = 'La descripcion es obligatoria y debe tener almenos 50 caracteres';
}
    if(!$this->habitaciones){
    self::$errores[] = 'Las habitaciones son obligatorias';
}
    if(!$this->wc){
    self::$errores[] = 'el wc es obligatorio';
}
    if(!$this->estacionamiento){
    self::$errores[] = 'El estacionamiento es obligatorio';
}
    if(!$this->vendedores_id){
    self::$errores[] = 'elije un vendedor';
}
if(!$this->imagen ) {
      self::$errores[] = 'La imagen es obligatoria ';
}


        return self::$errores;

    
}
//Lista todas las propiedades
public static function all() {
 $query = "SELECT * FROM propiedades";

   $resultado = self::consultarSQL($query); 
   return $resultado;
}
    public static function consultarSQL($query){
        //consultar la base de datos
        $resultado = self::$db->query($query);
        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }
        //liberar la memoria
        $resultado->free();
        //retornar los resultado
        return $array;
    }
protected static function crearObjeto ($registro) {
    $objeto = new self;
    foreach($registro as $key => $value) {
        if(property_exists($objeto, $key)) {
            $objeto->$key = $value;
        }
    }
    return $objeto;
}
}


