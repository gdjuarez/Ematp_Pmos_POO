<?php


//require ("../conexion/conexion.php");


    class Dispositivo extends Conexion{

    public function __construct(){

     parent::__construct();
	   
    }


      public function get_dispositivos(){
     
         $resultado = $this->conexion_db->query('SELECT id, dispositivo, n_serial, numero,estado,Apellido,Curso FROM  dispositivo');

          $registro_disp = $resultado->fetch_all(MYSQLI_ASSOC);

          //pedimos que nos devuelva el array
          return $registro_disp;

      }

      public function get_cantidad_registros(){
     
        $resultado = $this->conexion_db->query('SELECT COUNT(*) total  FROM  dispositivo');

         $cant_registro = $resultado->fetch_all(MYSQLI_ASSOC);

         //pedimos que nos devuelva el array
         return $cant_registro;

     }








    }

	?>

<?php
  
   //Creamos una instancia de la  clase devuelve 

   /*   $mis_dispositivos = new Dispositivo();

     $array_dispositivos=$mis_dispositivos->get_dispositivos();


 foreach($array_dispositivos as $elemento)
 {
   


 } */
?>


</body>
</html>
