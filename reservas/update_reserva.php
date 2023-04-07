<?php

// Include database connection
include("../clases/class_conexion.php");
include("../clases/class_reservas.php");


$mis_Reservas = new Reserva();

//---  recibo array detalle ---------	
$miArray=$_POST['valores'];
// id, dispositivo,numero,fecha,turno,curso,apellido,usuario

echo "reserva aca !!!!";

//---  Recorro el Array Y armo los values ------
//$values = array();

foreach($miArray as $detalle)
	{
	    $checkeado = $detalle[0];
   		$dispositivo_id = $detalle[1];
        $dispositivo = $detalle[2];
		$numero = $detalle[3];
		$fecha = $detalle[4];
		$turno = $detalle[5];
		$hora = $detalle[6];	
		$curso = $detalle[7];	
		$apellido = $detalle[8];	
		$usuario = $detalle[9];

		$dispositivo=$dispositivo.'-'.$numero;

			

			if($checkeado =='1'){

						// tabla reserva: id	dispositivo_id	Dispositivo	Fecha	Turno	Curso	Profesor	usuario	
				$insert=$mis_Reservas->create($dispositivo_id , $dispositivo, $fecha, $turno,$hora,$curso,$apellido,$usuario);				
	
			
					if(!$insert)
					{
						
						echo  ' <div class="alert alert-danger">  Error     </div>';
	
					}
			
	
			}

		}


	


?>