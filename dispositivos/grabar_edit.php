<?php
include("../conexion/conexion.php");

$id=$_POST['id'];
$dispositivo= $_POST['dispositivo'];
$serial= $_POST['serial'];
$numero= $_POST['numero'];
 
//echo $id.' '.$dispositivo .' '.$serial.' '.$numero;


$sql_disp = 'UPDATE dispositivo
			  SET dispositivo = "'.$dispositivo.'",
			  n_serial = "'.$serial.'",
			  numero = '.$numero.'
			WHERE id = "'.$id.'"';

		//echo $sql_disp;
	//	echo ('<br>');

$update = mysqli_query($miConexion,$sql_disp);

	if(!$update)
	{
		echo '<script language=javascript>
		alert("Hubo un error en el registro")
		self.location = "dispositivos.php"</script>';
  
	   
	  }else{
		echo '<script language=javascript>
			//alert("Registrado")
			self.location = "dispositivos.php"</script>';
			
	  }

	 



?>