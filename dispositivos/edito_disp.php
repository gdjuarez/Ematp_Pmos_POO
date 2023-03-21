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
require("../clases/class_dispositivo.php");

$id=$_GET['id'];


// instancio  dispositivos y consulto funcion get
$mis_dispositivos = new Dispositivo();


$reg_disp=$mis_dispositivos->get_disp($id);


foreach ($reg_disp as $row) {
    # code...
    $dispositivo= $row['dispositivo'];
	$serial= $row['n_serial'];
	$numero= $row['numero'];
}

//CIERRO CONEXION
//mysqli_close($miConexion); 

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
    <script   src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
    <!-- css personalizado-->
    <link rel="stylesheet" href="../stylefondo.css">

    <!-- js personalizado -->
    <script language="JavaScript">
        
        $( document ).ready(function() {

          $('#myModal').modal('toggle')

        });
    </script>

</head>

<header>
    <div class="container">
        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">Dispositivos Tecnológicos</h1>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
                <a class="navbar-brand" href="#"> </a>

                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"
                    id="alta_disp" title="Ingresar"> Editar </button>

                <form class="form-inline my-2 my-lg-0" action="..prestamos/menu.php" method="post">
                    <button class="btn btn-dark " type="submit"><small>volver</small></button>
                </form>
            </nav>

        </div>

</header>

<body>
    <div class='container bg-light border rounded'>
        <div class="row">
            <div class="col-md-1"> </div>

            <div class="col-md-10 ">
                <div style="height: 400px; background-color: rgba(255,0,0,0);">

                    <!-- ************************* M O D A L ***************************     -->
                    <!-- Trigger the modal with a button 
                 <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal_sesion" id="inicio_sesion"
                title="buscar"><i class="fas fa-search-plus"></i> Iniciar session </button>    -->

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-sm">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar de dispositivo</h5>
                                </div>

                                <div class="modal-body">
                                    <form action="grabar_edit.php" method="post">

                                        <!-- dispositivo n_serial  numero estado Apellido Curso -->
                                        <div class="form-group">
                                            <label>codigo:</label>
                                            <input type="text" class="form-control" name="id" value="<?php echo $id ?>"
                                                maxlength="20" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Dispositivo:</label>
                                            <input type="text" class="form-control" name="dispositivo"
                                                value="<?php echo $dispositivo ?>" maxlength="20" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Serial:</label>
                                            <input type="text" class="form-control" name="serial"
                                                value="<?php echo $serial ?>" maxlength="20">
                                        </div>
                                        <div class="form-group">
                                            <label>Numero:</label>
                                            <input type="text" class="form-control" name="numero"
                                                value="<?php echo $numero ?>" maxlength="20">
                                        </div>

                                        <button type="submit"
                                            class="btn btn-info btn-block btn-round">registrar</button>
                                    </form>
                                    <!-- <button type="button" class="close" id="cerrarA" data-dismiss="modal">&times;</button> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- ********************************************************************************     -->


                </div>

            </div>

        </div>
        <div class="col-md-1">
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