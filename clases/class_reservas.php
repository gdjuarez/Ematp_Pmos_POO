<?php


//require ("../conexion/conexion.php");


    class Reserva extends Conexion{

    public function __construct(){

     parent::__construct();
	   
    }


      public function get_reservas($dia){
     
         $resultado = $this->conexion_db->query("SELECT id, dispositivo_id, Dispositivo, date_format(fecha,'%d/%m/%Y') as Fecha,Turno,Hora, Curso, Profesor, usuario FROM reserva where Fecha = '$dia' order by Fecha,Turno,Hora ");

          $registro_reservas = $resultado->fetch_all(MYSQLI_ASSOC);

          //pedimos que nos devuelva el array
          return $registro_reservas;

      }

      public function listar_disp_reservar(){
        $listado = $this->conexion_db->query("SELECT id, dispositivo,numero FROM  dispositivo where dispositivo <> 'netbook'");
        $dispositivos_reservar = $listado->fetch_all(MYSQLI_ASSOC);

          //pedimos que nos devuelva el array
          return $dispositivos_reservar;


      }

      
        public function create($dispositivo_id, $dispositivo, $fecha, $turno, $hora, $curso,$apellido,$usuario)  {

          $sql_reserva = "INSERT INTO reserva (dispositivo_id,Dispositivo,Fecha,Turno,Hora,Curso,Profesor,usuario) 
				                  values ($dispositivo_id , '".$dispositivo."', '".$fecha."', '".$turno."','".$hora."','".$curso."','".$apellido."','".$usuario."')";

          $res = mysqli_query($this->conexion_db, $sql_reserva);

          if ($res) {
            return true;
          } else {
            return false;
          }
        }




      



    }


?>


</body>
</html>
