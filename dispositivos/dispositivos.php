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

// instancio  dispositivos y consulto funcion get
$mis_dispositivos = new Dispositivo();

$array_dispositivos=$mis_dispositivos->get_dispositivos();

$cant_registros=$mis_dispositivos->get_cantidad_registros();

foreach ($cant_registros as $reg) {
    # code...
    $cantidad_registros=$reg['total'];
}

?>
<!doctype html>
<html lang="es">

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

    function avisom(url) {
        if (!confirm(
                "ALERTA!!!!!!\n va a EDITAR este registro,\n si desea editarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR. "
            )) {
            return false;
        } else {
            document.location = url;
            return true;
        }
    }
    </script>
</head>

<header>
    <div class="container">
        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">Alta de Dispositivos Tecnológicos</h1>
                </div>
                <div class="col-lg-2">
                <p>usuario:  <?php echo $_SESSION['user'];?></p>
                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
                <a class="navbar-brand" href="#"> </a>

                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_sesion"
                    id="alta_disp" title="Ingresar"> Alta Dispositido + </button>

                <form class="form-inline my-2 my-lg-0" action="../prestamos/menu.php" method="post">
                    <button class="btn btn-dark " type="submit"><small>volver</small></button>
                </form>
            </nav>

        </div>

</header>

<body>
    <div class='container bg-light border rounded'>
        <div class="row">
            <div class="col-md-3">
                
        <!-- ************************* M O D A L ***************************     -->
        <!-- Trigger the modal with a button 
        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal_sesion" id="inicio_sesion"
            title="buscar"><i class="fas fa-search-plus"></i> Iniciar session </button>    -->

        <!-- Modal -->
        <div class="modal fade" id="myModal_sesion" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alta de dispositivo</h5>
                    </div>

                    <div class="modal-body">
                        <form action="grabar_disp.php" method="post">                            

         <!-- dispositivo n_serial  numero estado Apellido Curso -->
                            <div class="form-group">
                                <label>Dispositivo:</label>
                                <input type="text" class="form-control" name="dispositivo"   maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label>Serial:</label>
                                <input type="text" class="form-control" name="serial"  maxlength="20">
                            </div>
                            <div class="form-group">
                                <label>Numero:</label>
                                <input type="text" class="form-control" name="numero"  maxlength="20">
                            </div>
                          
                            <button type="submit" class="btn btn-info btn-block btn-round">registrar</button>
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
            <div class="col-md-6">
                <div id="chequeo">
                    <form action="cursosUpdate.php" method="POST">
                        <table class="table table-sm table-hover text-center table-responsive" id="tablaPmo">

                            <tr class="sticky-top  text-center alert alert-info role='alert'>">
                                <th>Dispositivo</th>
                                <th>Serial</th>
                                <th>Numero</th>
                                <th>Editar</th>
                                
                            </tr>

                            <?php 

                        foreach($array_dispositivos as $row) {
                                   $id=$row['id']; 
                                  
                    
                    ?>
                        <tr>
                               <td><?php echo $row['dispositivo']; ?></td>
                                <td><?php echo $row['n_serial']; ?></td>
                                <td><?php echo $row['numero']; ?></td>
                              
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:;" class="btn btn-warning"
                                            onclick="avisom('edito_disp.php?id=<?php echo $id?>'); return false;"><i
                                                class="fas fa-marker"></i></a>
                                    </div>
                                </td>
                </div>
                </tr>

                <?php
                     }
                 
                 //cierro conex
               //  mysqli_close($miConexion);
                ?>
                </table>
                <div class="alert alert-info" role="alert">
                <?php 	echo "<p align='center'> Cant. de registros: ".$cantidad_registros."</p>";	?>
                <div>
                </form>
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