<?php
session_start();

require ("../clases/class_conexion.php");
require ("../clases/class_login.php");

//Recibir y cifrar pass
$user = strip_tags($_POST['user']);
$pass = strip_tags(sha1($_POST['pass']));


//Creamos una instancia de la clase login
$mi_login = new Login();
//llamamos el metodo indentificacion de la clase para verificar usuario
$array_datos=$mi_login->identificacion($user,$pass);
// veo si el array tiene registros
$registro=count($array_datos);

 //echo $registro;

    if ($registro > 0) {

		foreach($array_datos as $elemento) {		
			$usuario=$elemento['user'];
			$roll=$elemento['roll'];		
		
			$_SESSION['logged'] = 'yes';
			$_SESSION['user'] = $usuario;
			$_SESSION['roll'] = $roll;	

		 }
		 echo '<script>window.location="../prestamos/menu.php"</script>';	

	}else{

		// echo' no existe usuario ';
		echo '<script language=javascript>
		 alert("Usuario y/o clave, son incorrectos")
		 self.location = "../index.php"</script>';	
	}




?>


</body>
</html>
