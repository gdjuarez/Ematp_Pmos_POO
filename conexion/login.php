<?php
session_start();

require "conexion.php";

//Recibir
$user = strip_tags($_POST['user']);
$pass = strip_tags(sha1($_POST['pass']));


class Login extends Conexion{	

    public function __construct(){

    /*Llamamos al constructor de la clase padre mediante el uso de parent lo que nos permite ejecutar el constructor de
    la clase conexión y el código extra que agreguemos en esta función que lo hereda*/

     parent::__construct();

    }
	  /*Método que se encarga de hacer la consulta SQL y devuelve un array con los registros  */

      public function get_login($user,$pass){
		/*Podemos usar la variable conexion_db gracias a la herencia */ 
		/*creamos una consulta SQL */		
	
		  $consulta = $this->conexion_db->query('SELECT * FROM usuarios WHERE user="'.$user.'" AND pass="'.$pass.'" ');

		  echo $consulta;
 
		   //creamos un array asociativo que contendrá toda la información que estamos demandando de la mase de datos.
		   if($existe = $consulta->fetch_object(MYSQLI_ASSOC)) {

			$_SESSION['logged'] = 'yes';
			$_SESSION['user'] = $user;
			
			echo $existe->roll;

			$roll_numero=$existe->roll;
			//nota :  aca veer que roll  es y derivar al menu correcto
		
			$_SESSION['roll'] = $roll_numero;
		
			echo $roll_numero;
		
			/* 
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
		  
		  */
		    
		   //pedimos que nos devuelva el array
		   //return $productos;
 
	    } 
	}
 }
 
	
	 $conex=new Conexion();
 
	 $conex.get_login($user,$pass);


 
?>