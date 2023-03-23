<?php


//require database connection
require("../clases/class_conexion.php");
require("../clases/class_dispositivo.php");

$miDispositivo= new Dispositivo();
$miPrestamo= new Prestamo();

//$array_dispositivos=$miEstado->updateEstado($id,$estado,$apellido,$curso);

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

			$estado="BLOQUEADA";

			if($checkeado =='1'){

				// $sql_disp = 'UPDATE dispositivo
				// 		  SET estado = "'.$estado.'",
				// 		  Apellido = "'.$apellido.'",
				// 		  Curso = "'.$curso.'"
				// 		WHERE id = "'.$id.'"';
	
					//echo $sql_disp;
				//	echo ('<br>');
	
				//$update = mysqli_query($miConexion,$sql_disp);
				$update =$miDispositivo->updateEstado($id,$estado,$apellido,$curso);
				echo $update;
	
					if(!$update)
					{
						echo '...ERROR!!! conexion';
		
					}
	
				$insert= $miPrestamo->create($dispositivo_id,$dispositivo,$Apellido,$curso,$fecha,$usuario);
				/* $sql_pmo = "INSERT INTO prestamos (dispositivo_id,	dispositivo,Apellido,Curso,fecha,usuario) 
				values ('$id', '".$dispositivo."', '".$apellido."', '".$curso."','".$hoy."','".$usuario."')"; */	
				//echo $sql_pmo;	
				//$insert = mysqli_query($miConexion,$sql_pmo);	

					if(!$insert)
					{
						echo '...ERROR!!! conexion';
	
					}
	
	
			}
			
		}
	
	}

		

		
	  


	


?>