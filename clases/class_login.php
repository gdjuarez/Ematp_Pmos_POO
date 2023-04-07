<?php

//require "conexion.php";

    class Login extends Conexion{

    public function __construct(){

     parent::__construct();
	      //Llamamos al constructor de la clase padre 

    }

         
      public function get_usuarios(){      
       /*creamos una consulta SQL */
          $resultado = $this->conexion_db->query('SELECT * FROM usuarios');

          $registro_usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

          //pedimos que nos devuelva el array
          return $registro_usuarios;
      }

      


    }
