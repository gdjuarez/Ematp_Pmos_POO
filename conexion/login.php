<?php
session_start();

require "conexion.php";

//Recibir
$user = strip_tags($_POST['user']);
$pass = strip_tags(sha1($_POST['pass']));

 /*Aquí vemos el primer ejemplo de herencia donde la clase Devuelve Productos utiliza
 aquellas variables y métodos definidas en el archivo conexión php y que estas sean
  accesibles es decir dependiendo de los modificadores de acceso que esta tenga  */

    class Login extends Conexion{

    public function __construct(){

     parent::__construct();
	   /*Llamamos al constructor de la clase padre mediante el uso de parent lo que nos permite ejecutar el constructor de
    la clase conexión */

    }

   /*Método que se encarga de hacer la consulta SQL y devuelve un array con los registros de usuarios */

      public function get_usuarios(){
       /*Podemos usar la variable conexion_db gracias a la herencia */

       /*creamos una consulta SQL */
         $resultado = $this->conexion_db->query('SELECT * FROM usuarios');

          $registro_usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

          //pedimos que nos devuelva el array
          return $registro_usuarios;

      }


    }

	?>

<?php
  
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
