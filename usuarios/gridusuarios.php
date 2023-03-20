<?php
session_start();
if($_SESSION['logged'] == 'yes' )
{
	//echo 'Usuario: '.$_SESSION['user'];	
	 //echo "Usuario: ". $_SESSION['user']."</div>";
}else{
	
    echo '<script language=javascript>
    alert("No te has logeado, inicia sesion")
    self.location = "../index.php"</script>';
}
?>
<?php
// Include database connection
 include("../conexion/conexion.php");
?>
<?php 

// consulta a la tabla usuarios
$consulta="SELECT id,user,apellido_nombre FROM usuarios";

$resultados = mysqli_query($miConexion,$consulta); 

// cantidad de registros
   $cantidad_registros = mysqli_num_rows($resultados);


//Creo la tabla y lleno con la consulta
    $dyn_table= "<table id='Tabla' class='table table-striped' >";
	$dyn_table.= "<td>" . "Id" ."</td>";  
    $dyn_table.= "<td>" . "Usuario" ."</td>";
	$dyn_table.= "<td>" . "Apellido & Nombre ". "</td>";


while($row = mysqli_fetch_row($resultados)){ 
    
	
    $id = $row[0];
    $member_name = $row[1];
    $apellido_nombre = $row[2];
	
		$dyn_table.= "<tr>"; 
		$dyn_table.= "<td>" . $id ."</td>";
		$dyn_table.= "<td>" ."<input type='submit' name='caja' class='btn btn-secondary btn-block' value='".$member_name."'/>"."</td>";         
		$dyn_table.= "<td>" . $apellido_nombre . "</td>";
		$dyn_table.= "</tr>";
    
}
$dyn_table.="</tr></table>";

 mysqli_close($miConexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Usuarios</title>
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

<body>
    <header>
    <div class="container">
        <div class="banner  rounded" style="background-color:  #FF5733;">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-8">
                    <h1 class="text-left text-white">Listado de usuarios</h1>
                </div>
            </div>
            <nav class="navbar navbar-light bg-white rounded">
                <!-- Navbar content -->
                <a class="navbar-brand" href="#"></a>
               
                <form class="form-inline my-2 my-lg-0" action="registroUsuarios.php" method="post">
                    <button class="btn btn-dark " type="submit"><small>volver</small></button>
                </form>
            </nav>

        </div>
          
    </header>
    <!--DE AQUI COMIENZA SI DESEAR COPIAR A TU SITIO WEB TOMALO COMO SI EMPEZARAS DESDE BODY-->

    <div class='container bg-light border rounded'>
        <div class='row align-items-center'>
            <div class="col-md-3"> </div>
            <div class="col-md-6">
                <div id="listado" align="center"> </div>
                <div id="chequeo" align="center">
                    <form action="registroUsuarios.php" method="POST">
                        <?php 
								echo $dyn_table;
								echo "<p align='center'> Cant. de registros: ".$cantidad_registros."</p>";
								?>
                    </form>
                </div>

               
            </div>
            <div class="col-md-3"> </div>
        </div>
        <hr>
        <footer>
            <small>&copy; Copyright 2022, GDJuarez</small>
        </footer>
    </div>

</body>

</html>