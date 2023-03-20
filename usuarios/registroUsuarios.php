<?php
session_start();
if($_SESSION['logged'] == 'yes' AND $_SESSION['roll'] <= '2')
{
	//echo 'Usuario: '.$_SESSION['user'];	
	 //echo "Usuario: ". $_SESSION['user']."</div>";
}else{
	
    echo '<script language=javascript>
    alert("No te has logeado, inicia sesion")
    self.location = "../index.php"</script>';
}

include("../conexion/conexion.php");

//NO MUESTRA ERROR al cargar
error_reporting(error_reporting() & ~E_NOTICE);

$usuario_eliminar='';

//Recibir
if(isset($_POST['user'])){
    $usuario=$_POST['user'];
}

if(isset($_POST['pass'])){
    $pass = strip_tags(sha1($_POST['pass']));
}

if(isset($_POST['apellido_nombre'])){
    $apellido_nombre =strip_tags($_POST['apellido_nombre']);
}

if(isset($_POST['roll'])){
    $roll =$_POST['roll'];
}

//********************************** */

if(isset($_POST["submit"])){
	$boton=$_POST["submit"];
	if($boton=="Registrar"){
		
	//verifico que no este VACIO el campo usuario
		if(isset($_POST['user']) && empty($_POST['user'])){
	
			echo '<script language=javascript>
		  		alert("Usuario y/o clave, son obligatorios")
		  		self.location = "registroUsuarios.php"</script>';
	
 		}else{

			$query = mysqli_query($miConexion,'SELECT * FROM usuarios WHERE user="'.mysqli_real_escape_string($miConexion,$usuario).'"');
			if($existe = mysqli_fetch_object($query))
		{
			//echo 'El usuario '.$user.' ya existe.';
			echo '<script language=javascript>
		  		alert("Usuario ya existe") </script>';			
			
		}else{
			$grabar = mysqli_query($miConexion,'INSERT INTO usuarios (user, pass, apellido_nombre, roll) 
            values ("'.($usuario).'", "'.($pass).'", "'.($apellido_nombre).'","'.$roll.'")');
		
		if($grabar)
		{
			echo "<script language=javascript>
			  	alert('Usuario registrado con exito')
			  	self.location = 'registroUsuarios.php'
                  </script>";
			  	
		}else{
		
			echo "<script language=javascript>
		  		alert('Hubo un error en el registro')
		  		self.location = 'registroUsuarios.php'</script>";	
		}
 	  }
	}
  }
  if($boton=="Eliminar"){
	  
	//verifico que no este VACIO el campo usuario
if(isset($_POST['user']) && empty($_POST['user'])){
	
	echo '<script language=javascript>
		  alert("Ingrese Usuario a eliminar")
		  self.location = "registroUsuarios.php"</script>';
		  	
 }else{

		$query = mysqli_query($miConexion,'SELECT * FROM usuarios WHERE user="'.mysqli_real_escape_string($miConexion,$usuario).'"');
		if($existe =!mysqli_fetch_object($query))
		{
			//echo 'Usuario: '.$user.' encontrado para eliminar.';
			echo '<script language=javascript>
				  alert("No existe Usuario ")
				  self.location = "registroUsuarios.php"</script>';	
				
		}else{
			$borrar = mysqli_query($miConexion,'DELETE FROM usuarios WHERE user="'.mysqli_real_escape_string($miConexion,$usuario).'"');
			
			if($borrar)
			{
				echo '<script language=javascript>
				  alert("Usuario eliminado con exito")
				  self.location = "registroUsuarios.php"</script>';				 
							
			}else{
				
				echo '<script language=javascript>
				  alert("no se elimino!!")
				  self.location = "registroUsuarios.php"</script>';	
			}
   }
  }
 }
}


?>
<?php 
//Recibo desde la grid
if (isset($_POST['caja'])) {
       $usuario_eliminar= $_POST['caja'];	
	  // echo ($usuario_eliminar);

	} else {
   //echo "nada";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro de usuarios</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--FavIcon-->
    <link rel="shortcut icon" href="../img/yo.png" type="image/png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../stylefondo.css">
</head>

<script src="../Jquery/jquery-2.1.3.min.js"> </script>

</head>

<body>
    <header>
    <div class="container">
        <div class="banner  rounded" style="background-color:#FF5733;">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-8">
                    <h1 class="text-left text-white"></h1>
                </div>
            </div>
            <nav class="navbar navbar-light bg-danger rounded">
                <!-- Navbar content -->
                <a class="navbar-brand" href="#"></a>
                <h5 class="text-center text-white">Registro de Usuarios</h5>
                <form class="form-inline my-2 my-lg-0" action="../prestamos/menu.php" method="post">
                    <button class="btn btn-dark " type="submit"><small>volver</small></button>
                </form>
            </nav>

        </div>
    </header>

    <div class='container bg-light border rounded'>
        <div class="row p-4">
            <div class="col-md-4"> </div>

            <div class="col-md-4">
                <h3>Usuario</h3>
                <form action="registroUsuarios.php" method="POST">

                    <p><input type="text" name="apellido_nombre" class="form-control" value=""
                            placeholder="Apellido & Nombre" required></p>
                    <p><select class="form-control input-sm" id="roll" name="roll" title='Seleccione.'>
                            <option value="4">Profesor/a</option>
                            <option value="2">ematp/bibliotecario</option>
                            <option value="1">Admin</option>
                        </select></p>
                    <p><input type="text" name="user" class="form-control" value="<?php echo $usuario_eliminar ?>" placeholder="Usuario" required></p>
                    <p><input type="password" name="pass" class="form-control" value="" placeholder="clave" required>
                    </p>
                    <input type="submit" name="submit" value="Registrar" class="btn btn-primary mb-2" />
                    <input type="submit" name="submit" value="Eliminar" class="btn btn-danger mb-2" />
                </form>

                <div id="lista" align="center" style="padding:10px">
                    <form action="gridusuarios.php" method="POST">
                        <input name="Enviar" type="submit" value="Listar usuarios"
                            class="btn btn-outline-primary btn-block" />
                    </form>
                </div>

                <hr>
               
            </div>

            <div class="col-md-4"> </div>

            <hr>
            <footer>
                <small>&copy; Copyright 2022, GDJuarez</small>
            </footer>
        </div>

          <!--   sweet alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>