<?php
require("../clases/class_conexion.php");
require("../clases/class_prestamo.php");
require("../clases/class_dispositivo.php");

$mis_dispositivos = new Dispositivo();
$mis_prestamos = new Prestamo();

$array_dispositivos=$mis_dispositivos->get_dispositivos();

foreach($array_dispositivos as $elemento) { }

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

		if($estado=="disponible"){

			$estado=" Prestada ";

			if($checkeado =='1'){	
					
				$update = $mis_dispositivos->update_prestado($estado,$apellido,$curso,$id);
	
					if(!$update)
					{
						echo '...ERROR!!! conexion';
		
					}
			
				$insert = $mis_prestamos->create($id,$dispositivo,$apellido,$curso, $hoy, $usuario);

					if(!$insert)
					{
						echo '...ERROR!!! conexion';
	
					}
	
	
			}
			
		}
	
	}

		

		
	  


	


?>