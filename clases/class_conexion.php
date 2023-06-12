<?php
 require_once('../conexion/config.php'); 

 class Conexion{

    protected $conexion_db;
    
    public function __construct(){
 
        $this->conexion_db = new mysqli(DB_HOST, DB_USUARIO, DB_PASS,DB_NOMBRE); 
 
        //En caso de que la conexion no tenga exito.
 
        if( $this->conexion_db->connect_errno) {
 
          echo "Fallo al conectar a MySQL:" . $this->conexion_db->connect_error;
          return;
        }else{
           // echo  ' <div class="alert alert-info">  conectado     </div>';
        }
 
        //Establecemos el juego de caracteres para poder admitir ñ entre otros  caracteres
 
        $this->conexion_db->set_charset(DB_CHARSET);
 
    }
   

  }

 
?>

