<?php
session_start();

if($_SESSION['logged'] == 'yes' AND $_SESSION['roll'] <= '3')
{
	//echo 'Usuario: '.$_SESSION['user'];	
	 //echo "Usuario: ". $_SESSION['user']."</div>";
}else{
	
    echo '<script language=javascript>
    alert("No te has logeado, inicia sesion")
    self.location = "../index.php"</script>';
}

// Include database connection
require("../clases/class_conexion.php");
require("../clases/class_prestamo.php");

$hoy = date("Y/m/d");   
$apellido='';
$curso='';
//-----------------------


if(isset( $_POST['fecha'])){
    $fecha = $_POST['fecha'];
}else{
    $fecha = date("Y/m/d");   
}

$prestamos= new Prestamo();

if($fecha!=''){
        
    //$prestamos= new Prestamo();
    $array_pmo=$prestamos->get_prestamos($fecha);
  
}else{
    echo '<div class="alert  alert-danger text-center"> Ingrese Fecha </div>';
}

 ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--fontawesome icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <title>Menu</title>
    <!-- jquery-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
   
    <!-- css personalizado-->
    <link rel="stylesheet" href="../stylefondo.css">
</head>

<header>
    <div class="container">
        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">Listado de Prestamos</h1>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
                <a class="navbar-brand" href="#"></a>
                <form class="form-inline my-2 my-lg-0" action="gridPmo.php" method="post">
                         <input type="date" id='fecha' class="form-control form-control-sm text-center"  name="fecha" value="<?php echo  $fecha ?>">
                         <button class="btn btn-primary " type="submit"><small>listar</small></button>
                </form>
                <form class="form-inline my-2 my-lg-0" action="menu.php" method="post">
                    <button class="btn btn-dark " type="submit"><small>volver</small></button>
                </form>
              
            </nav>

        </div>
       
    </div>

</header>

<body>
    <div class='container bg-light border rounded '>
        <div class="row ">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div id="chequeo">

                    <table class="table table-sm table-hover text-center table-responsive" id="tablaPmo">

                        <tr class="sticky-top rounded bg-secondary text-center">
                      
                            <th>Dispositivo</th>
                            <th>Apellido</th>
                            <th>Curso</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                        </tr>

                        <?php if ($fecha!='') {
                            foreach($array_pmo as $row)
                           { ?>
                        <tr>
                          
                            <td><?php echo $row['dispositivo']; ?></td>
                            <td><?php echo $row['Apellido']; ?></td>
                            <td><?php echo $row['Curso']; ?></td>                          
                            <td><?php echo $row['fecha']; ?></td>   
                            <td><?php echo $row['usuario']; ?></td>   
                            
                           
                </div>
                </tr>

                <?php
                     }
                 }
                 //cierro conex
                 $prestamos->cerrar_conexion();
                // mysqli_close($miConexion);
                ?>
                </table>

               

                <div class="row align-items-right p-4">
            <div class="col-md-2"> 
          
            <td>      
            </div>           
          
        </div>

            </div>
        </div>

    </div>
    <div class="col-md-3">  

    </div>
    <hr>

    <footer>
        <small>&copy; Copyright 2022, GDJuarez</small>
    </footer>
    </div>
    <!-- Option 1: Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

</body>

</html>