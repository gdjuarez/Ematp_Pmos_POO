<?php



// Include database connection
require("../clases/class_conexion.php");
require("../clases/class_dispositivo.php");


$id=$_POST['id'];
$dispositivo= $_POST['dispositivo'];
$serial= $_POST['serial'];
$numero= $_POST['numero'];
 
//echo $id.' '.$dispositivo .' '.$serial.' '.$numero;



// instancio  dispositivos y consulto funcion get
$mis_dispositivos = new Dispositivo();


if((isset($_POST['id']))){

  
  //llamo a la funcion create de la clase dispositivo
  $res= $mis_dispositivos->Update($id,$dispositivo,$serial,$numero);

  
  if($res==false)	
	{
		echo '<script language=javascript>
		alert("Hubo un error en el registro")
		self.location = "dispositivos.php"</script>';
  
	   
	  }else{
		echo '<script language=javascript>
			//alert("Registrado")
			self.location = "dispositivos.php"</script>';
			
	  }

	 
	}


?>