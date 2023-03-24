<?php
include("../conexion/conexion.php");
// fecha de hoy formato
$hoy = date("Y/m/d");   

//---  recibo array detalle ---------	
$miArray=$_POST['valores'];

//---  Recorro el Array Y armo los values ------
$values = array();

foreach($miArray as $detalle)
	{
	    $checkeado = $detalle[0];
   		$id = $detalle[1];
        $dispositivo = $detalle[2];           
        $n_serial = $detalle[3];
		$numero = $detalle[4];
		$estado = $detalle[5];
		$apellido = $detalle[6];
		$curso = $detalle[7];
		$usuario = $detalle[8];

		$dispositivo=$dispositivo.'-'.$numero;

		if($estado<>"disponible"){


			$estado="disponible";

			if($checkeado =='1'){

				$update = $mis_dispositivos->update_recibido($estado,$apellido,$curso,$id);
	
					if(!$update)
					{
						echo '...ERROR!!! conexion';
		
					}
		
				$insert = $mis_prestamos->create_prestamo($id,$dispositivo, 'devuelta', '-', $hoy, $usuario);	
					if(!$insert)
					{
						echo '...ERROR!!! conexion';
	
					}
	
	
			}

		}

		
	  


	}


?>