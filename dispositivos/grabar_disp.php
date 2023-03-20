<?php
include('../conexion/conexion.php');

$pre='';
$num='';

$dispositivo=$_POST['dispositivo'];
$serial=$_POST['serial'];
$numero=$_POST['numero'];
$estado='disponible';
$Apellido='';
$curso='';

if((isset($_POST['dispositivo']))){
     
    
  $sql = "INSERT INTO dispositivo (dispositivo,n_serial,numero,estado,Apellido,Curso) 
  values ('".$dispositivo."', '".$serial."', '.$numero.','".$estado."', '".$Apellido."', '".$curso."')";

  //echo $sql;

  $insert = mysqli_query($miConexion,$sql);	
    if(!$insert)
    {
      echo '<script language=javascript>
      alert("Hubo un error en el registro")
      self.location = "dispositivos.php"</script>';

     
    }else{
      echo '<script language=javascript>
          alert("Registrado")
          self.location = "dispositivos.php"</script>';
    }
    
  }



?>