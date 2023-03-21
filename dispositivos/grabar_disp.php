<?php
require('../clases/class_conexion.php');
require('../clases/class_dispositivo.php');

$pre='';
$num='';

$dispositivo=$_POST['dispositivo'];
$serial=$_POST['serial'];
$numero=$_POST['numero'];
$estado='disponible';
$Apellido='';
$curso='';


// instancio  dispositivos y consulto funcion get
$mis_dispositivos = new Dispositivo();


if((isset($_POST['dispositivo']))){
     
  //llamo a la funcion create de la clase dispositivo
 $res= $mis_dispositivos->create($dispositivo,$serial,$numero,$estado,$Apellido,$curso);

  
    if($res==false)
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