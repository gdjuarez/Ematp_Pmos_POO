<?php

//require "conexion.php";

    class Login extends Conexion{

    public function __construct(){

     parent::__construct();
	   /*Llamamos al constructor de la clase padre mediante el uso de parent lo que nos permite ejecutar el constructor de
    la clase conexión */

    }

   /*Método que se encarga de hacer la consulta SQL y devuelve un array con los registros de usuarios */

      public function get_usuarios(){
       /*Podemos usar la variable conexion_db gracias a la herencia */

       /*creamos una consulta SQL */
         $resultado = $this->conexion_db->query('SELECT * FROM usuarios');

          $registro_usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

          //pedimos que nos devuelva el array
          return $registro_usuarios;

      }


    }

	?>
