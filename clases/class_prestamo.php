<?php


    //require ("../conexion/conexion.php");


    class Prestamo extends Conexion{

    public function __construct(){

     parent::__construct();
	   
    }
  
    public function create_prestamo($id,$dispositivo,$apellido,$curso, $hoy, $usuario){
     
      $sql = "INSERT INTO prestamos (dispositivo_id,dispositivo,Apellido,Curso,fecha,usuario) 
            values ('".$id."','".$dispositivo."', '".$apellido."', '.$curso.','".$hoy."', '".$usuario."')";
     
      $res = mysqli_query($this->conexion_db, $sql);
      
      if($res){
        return true;
      }else{
      return false;
     }
    }

    public function create_recibido($id,$dispositivo,$apellido,$curso, $hoy, $usuario){
     
      $sql = "INSERT INTO prestamos (dispositivo_id,dispositivo,Apellido,Curso,fecha,usuario) 
            values ('".$id."','".$dispositivo."', 'devuelta', '-','".$hoy."', '".$usuario."')";
     
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


</body>
</html>
