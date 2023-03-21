<?php
session_start();

require ("../clases/class_conexion.php");
require ("../clases/class_login.php");

//Recibir
$user = strip_tags($_POST['user']);
$pass = strip_tags(sha1($_POST['pass']));

  
   //Creamos una instancia de la  clase devuelve productos

     $usuarios = new Login();

     $array_usuarios=$usuarios->get_usuarios();


 foreach($array_usuarios as $elemento)
 {

	if($user==$elemento['user'] && $pass==$elemento['pass']){
	
		//echo 'user:'.$elemento['user'].' pass: '.$elemento['pass'];
		$roll_numero=$elemento['roll'];

		$_SESSION['logged'] = 'yes';
		$_SESSION['user'] = $user;
		$_SESSION['roll'] = $roll_numero;

		switch ($roll_numero) {
		
			case 1:
				//	1 Admin
				echo '<script>window.location="../prestamos/menu.php"</script>';
				break;
			case 2:
				//2 EMATP - BIBLIOTECARIO
				echo '<script>window.location="../prestamos/menu.php"</script>';
				break;
			case 4:
				//4 Profesor
				echo '<script>window.location="../reservas/reservas.php"</script>';
				break;
		}
			
			//echo '<script language=javascript>
			// alert("Logeado exitosamente ,Bienvenido!!")</script>';
			//echo '<script>window.location="prestamos/menu.php"</script>';
			
	  }else{
		  
		echo '<script language=javascript>
			  alert("Usuario y/o clave, son incorrectos")
			  self.location = "../index.php"</script>';										
	  }
	

   


 }
?>


</body>
</html>
