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


    }


?>


</body>
</html>
