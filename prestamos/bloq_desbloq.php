<?php

//require database connection
require("../clases/class_conexion.php");
require("../clases/class_dispositivo.php");

$miDispositivo= new Dispositivo();

// fecha de hoy formato
$hoy = date("Y/m/d");   

//recibo datos 
if(isset($_GET['id'])&& isset($_GET['estado'])){

    $id= $_GET['id'];
    $estado= $_GET['estado'];

      //echo $id.' '.$estado;
      if ($estado=='BLOQUEADA'){
        $estado='disponible';
      }else{
        $estado='BLOQUEADA';
      }

      echo 'nuevo estado:  '.$estado;

      $miDispositivo->updateEstado($id,$estado);



}
	
	

		

		
	  


	


?>