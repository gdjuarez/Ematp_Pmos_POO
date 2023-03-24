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

      //echo 'nuevo estado:  '.$estado;

      $res_estrado = $miDispositivo->updateEstado($id,$estado);


      if($res_estrado){

        echo '<div class="alert alert-success">Se cambio el Estado del dispositivo  <a href="bloqueada.php" class="btn btn-primary">volver</a>   </div>';

      }else{        

        echo '<div class="alert alert-danger">No se cambio el Estado del dispositivo  <a href="bloqueada.php" class="btn btn-primary">volver</a>   </div>';

      }


    
}
    
$miDispositivo->cerrar_conexion();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>bloquear/desbloquear</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body class="Bod bg-dark">
  
</body>
</html>