<?php
include('../conexion/conexion.php');

$hoy = date("Y/m/d"); 

$titulo=$_POST['titulo'];
$autor_editorial=$_POST['autor_editorial'];
$apellido=$_POST['apellido'];
$curso=$_POST['curso'];
$cantidad=$_POST['cantidad'];
$fecha=$hoy;
$observ='PRESTADO';

if((isset($_POST['titulo']))){
     
  // `id`, `titulo`, `autor_editorial`, `Apellido`, `curso`, `cantidad`, `fecha`, `observ
    
  $sql = "INSERT INTO prestamo_libro (titulo,autor_editorial,apellido,curso,cantidad,fecha,observ) 
  values ('".$titulo."', '".$autor_editorial."', '".$apellido."','".$curso."', '".$cantidad."','".$hoy."',  '".$observ."')";

 // echo $sql;

  $insert = mysqli_query($miConexion,$sql);	
    if(!$insert)
    {
      echo '<script language=javascript>
      alert("Hubo un error en el registro")
      self.location = "gridlibros.php"</script>';

     
    }else{
      echo '<script language=javascript>
       
          self.location = "gridlibros.php"</script>';
    }
    
  }



?>