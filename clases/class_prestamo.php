<?php


    //require ("../conexion/conexion.php");


    class Prestamo extends Conexion{

    public function __construct(){

     parent::__construct();
	   
    }
  
    public function create($dispositivo_id,$dispositivo,$Apellido,$curso,$fecha,$usuario){
     
      $sql = "INSERT INTO prestamos (dispositivo_id,dispositivo,Apellido,Curso,fecha,usuario) 
            values ('".$dispositivo_id."','".$dispositivo."', '".$Apellido."', '.$curso.','".$fecha."', '".$usuario."')";
     
      $res = mysqli_query($this->conexion_db, $sql);
      
      if($res){
        return true;
      }else{
      return false;
     }
    }
    

      public function get_prestamos($fecha){
     
         $resultado = $this->conexion_db->query("SELECT pmo_id,dispositivo_id,dispositivo,Apellido,Curso,date_format(fecha,'%d-%m-%Y') 
         as fecha,usuario FROM  prestamos where fecha ='".$fecha."' ORDER BY pmo_id Desc");

          $listado_pmos = $resultado->fetch_all(MYSQLI_ASSOC);

          //pedimos que nos devuelva el array
          return $listado_pmos;

      }

      public function cerrar_conexion(){

        $this->conexion_db->close();
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
