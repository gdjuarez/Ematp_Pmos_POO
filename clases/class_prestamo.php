<?php


    //require ("../conexion/conexion.php");


    class Prestamo extends Conexion{

    public function __construct(){

     parent::__construct();
	   
    }
  
    public function create($dispositivo,$serial,$numero,$estado,$Apellido,$curso){
     
      $sql = "INSERT INTO dispositivo (dispositivo,n_serial,numero,estado,Apellido,Curso) 
            values ('".$dispositivo."', '".$serial."', '.$numero.','".$estado."', '".$Apellido."', '".$curso."')";
     
      $res = mysqli_query($this->conexion_db, $sql);
      
      if($res){
        return true;
      }else{
      return false;
     }
    }

    public function update($id,$dispositivo,$serial,$numero){
     
      $sql_disp = 'UPDATE dispositivo
			  SET dispositivo = "'.$dispositivo.'",
			  n_serial = "'.$serial.'",
			  numero = '.$numero.'
			WHERE id = "'.$id.'"';

      $res = mysqli_query($this->conexion_db, $sql_disp);

      if($res){
        return true;
      }else{
      return false;
     }
    }

    public function get_disp($id){
     
      $resultado = $this->conexion_db->query("SELECT id, dispositivo, n_serial, numero ,estado, Apellido, Curso FROM dispositivo  where id =$id");

       $reg_disp = $resultado->fetch_all(MYSQLI_ASSOC);

       //pedimos que nos devuelva el array
       return $reg_disp;

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
