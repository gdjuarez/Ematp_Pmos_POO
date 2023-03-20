<?php 

include('../conexion/conexion.php');

//NO MUESTRA ERROR al cargar
//error_reporting(error_reporting() & ~E_NOTICE);


$numero=$_GET['id'];

    $sql_actualizar="UPDATE prestamo_libro SET 
      observ = 'DEVUELTO' 
    where id ='$numero' ";

         //echo $sql_actualizar;       
         
          $actualizar=mysqli_query($miConexion,$sql_actualizar)
            or die("error consulta: ");            
         
			if($actualizar)
			{

                echo '<script language=javascript>
                alert("DEVUELTO REGISTRADO")
                self.location = "gridlibros.php"</script>';            
          
			
			  }else{
				
                echo '<script language=javascript>
                alert("Hubo un error en el registro")
                self.location = "gridlibros.php"</script>';
			  }




?>


