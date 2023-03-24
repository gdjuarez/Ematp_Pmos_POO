<?php

session_start();

if ($_SESSION['logged'] == 'yes' and $_SESSION['roll'] <= '2') {
    //echo 'Usuario: '.$_SESSION['user'];	
    //echo "Usuario: ". $_SESSION['user']."</div>";
} else {

    echo '<script language=javascript>
      self.location = "../index.php"</script>';
}


// la clase dispositivo hereda de conexion 
require("../clases/class_conexion.php");
require("../clases/class_dispositivo.php");
require("../clases/class_reservas.php");

// fecha y hora del servidor
$DateAndTime = date('m-d-Y h:i:s a', time());

$hoy = date("Y/m/d");
$apellido = '';
$curso = '';
$ape = '';
$cur = '';
$disp_prestados = 0;


// instancio  dispositivos y consulto funcion get
$mis_dispositivos = new Dispositivo();

$array_dispositivos=$mis_dispositivos->get_dispositivos();

$dia = date('Y-m-d');

// instancio  reservas y consulto funcion get
$mis_reservas = new Reserva();

$array_reservas=$mis_reservas->get_reservas($dia);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--fontawesome icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <title>Menu</title>
    <!-- jquery
    <script src="../lib/jquery.js"></script>-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

    <!-- js personalizado -->
    <script src="scriptPrestamos.js"></script>
    <!-- css personalizado-->
    <link rel="stylesheet" href="../stylefondo.css">


</head>

<header>
    <div class="container">
        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">
                    <div class="boton btn btn-info ">
                        <?php echo "Fecha y Hora servidor:  $DateAndTime."  ?>
                    </div>

                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">Estado de prestamos</h1>
                </div>


                <div class="col-lg-2">
                    <p>usuario: <?php echo $_SESSION['user']; ?></p>
                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">

                <a class="nav-item dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ADMINISTRAR
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../reservas/reservas.php">RESERVAR</a>
                        <a class="dropdown-item" href="gridPmo.php">LISTADO</a>
                        <a class="dropdown-item" href="../dispositivos/dispositivos.php">DISPOSITIVOS</a>
                        <a class="dropdown-item" href="bloqueada.php">BLOQUEAR</a>
                        <a class="dropdown-item" href="../usuarios/registroUsuarios.php">USUARIOS</a>
                    </div>
                </a>
                <form class="form-inline" action="../prestamos_libros/gridlibros.php" method="post">
                    <button class="btn btn-primary " type="submit">L I B R O S</button>
                </form>
                <form class="form-inline" action="../destruir.php" method="post">
                    <button class="btn btn-outline-danger " type="submit"><small>cerrar sesion</small></button>
                </form>

            </nav>

        </div>
    </div>

</header>

<body>
    <div class='container bg-light border rounded '>
        <div class="row ">
            <div class="col-md-3">
                <?php
                echo "<div class='alert alert-warning'>";
                echo "RESERVAS DEL DIA";
                echo "</div>";

                foreach($array_reservas as $row) {
                    $id = $row['id'];
                    $turno = $row['Turno'];

                    if($turno==1){
                        $turno='MAÑANA';
                    }elseif($turno==2){
                        $turno='TARDE';
                    }elseif($turno==2){
                        $turno='VESPERTINO';
                    }

                    $dispositivo_id = $row['dispositivo_id'];
                    $dispositivo = $row['Dispositivo'];
                    $fecha = $row['Fecha'];
                    $hora = $row['Hora'];
                    $curso = $row['Curso'];
                    $profesor = $row['Profesor'];
                    $usuario = $row['usuario'];

                    echo "<div class='alert alert-info'>";
                    echo 'PROF: '.$profesor ;
                    echo '<br>';
                    echo 'TURNO: '.$turno ;
                    echo '<br>';
                    echo 'HORA: '.$hora;
                    echo '<br>';
                    echo 'DISP: '.$dispositivo;
                    echo '<hr>';                   
                    echo "</div>";
                }

                ?>

            </div>
            <div class="col-md-6">
                <table class="table table-responsive text-center" id="tablaBtn">
                    <tr>

                        <th>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalP" id="prestar"> PRESTAR </button>
                        </th>
                        <th>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalR" id="recibir"> RECIBIR </button>
                        </th>
                    </tr>

                </table>

                <table class="table-responsive">
                    <table  id="tablaPmo" class="table table-sm table-responsive table-hover text-center">

                        <tr class="Barra text-center >">
                            <th hidden>Codigo</th>
                            <th>Dispo</th>
                            <th hidden>Serial</th>
                            <th>#</th>
                            <th>Estado</th>
                            <th>Apellido</th>
                            <th>Curso</th>
                            <th>check</th>
                        </tr>

                        <?php 
                                 foreach($array_dispositivos as $row) { 

                                    $estado = $row['estado'];

                                    if ($estado == "disponible") {
                                        $boton_color = "class='alert alert-sm alert-success'";
                                        $color_fila="class='td '";
                                    } elseif ($estado == "BLOQUEADA") {
                                        $boton_color = "class='btn btn-sm btn-dark' ";
                                        $color_fila="class='td bg-dark '";
                                    } else {
                                        $boton_color = "class='alert alert-danger' ";
                                        $color_fila="class='td bg-danger text-white'";
                                        $disp_prestados += 1;
                                    }
                                    ?>

                                <tr <?php echo $color_fila ?>  >
                                    <td hidden><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['dispositivo']; ?></td>
                                    <td hidden><?php echo $row['n_serial']; ?></td>
                                    <td><?php echo $row['numero']; ?></td>

                                    <?php $estado = $row['estado'];
                                    $apellido = $row['Apellido'];
                                    $curso = $row['Curso'];

                                    ?>

                                    <td><small><input type='button' id='estado' <?php echo $boton_color ?> value='<?php echo $row['estado'] ?>'/></small></td>
                                    <td><small><?php echo $apellido ?></small></td>
                                    <td><small><?php echo $curso ?><small></td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" id='check' class="case form-check-input" value="0">
                                        </div>
                                    </td>

                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php  //cierro llaves del while
                            }
                         
                            ?>
                    </table>

                    <?php if ($disp_prestados == 0) {

                        echo " <div class='alert alert-success'>
                                <strong>Dispositivos Prestados: $disp_prestados </strong>  
                                </div>";
                    } else {

                        echo " <div class='alert alert-danger'>
                                <strong>Dispositivos Prestados:  $disp_prestados  </strong>  
                                </div>";
                    } ?>
            </div>
        </div>

        <div class="col-md-3">


            <!-- ************************* M O D A L ***************************     -->
            <!-- Trigger the modal with a button 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"
                    id="prestar" title="Ingresar"> retirar/devolver </button>  -->

            <!-- Modal -->
            <div class="modal fade" id="myModalP" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Prestar de dispositivo</h5>
                        </div>

                        <div class="modal-body">
                            <form action="#menu.php" method="post">

                                <!-- dispositivo n_serianumero estado Apellido Curso -->

                                <div class="form-group">
                                    <label id='labelape'>Apellido:</label>
                                    <input type="text" class="form-control" name="ape" id="ape" value="<?php echo $ape ?>" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <label id='labelcur'>curso:</label>
                                    <input type="text" class="form-control" name="cur" id="cur" value="<?php echo $cur ?>" maxlength="20">
                                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo  $_SESSION['user']; ?>" hidden>
                                </div>

                                <button type="submit" id=prestando class="btn btn-info btn-block btn-round">registrar</button>
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

            <!-- ************************* M O D A L ***************************     -->
            <!-- Trigger the modal with a button 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"
                    id="prestar" title="Ingresar"> retirar/devolver </button>  -->

            <!-- Modal -->
            <div class="modal fade" id="myModalR" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Recibir Dispositivo</h5>
                        </div>

                        <div class="modal-body">
                            <form action="#menu.php" method="post">

                                <!-- dispositivo n_serianumero estado Apellido Curso -->

                                <div class="form-group" hidden>
                                    <label id='labelape'>Apellido:</label>
                                    <input type="text" class="form-control" name="ape" id="ape" value="<?php echo $ape ?>" maxlength="20">
                                </div>
                                <div class="form-group" hidden>
                                    <label id='labelcur'>curso:</label>
                                    <input type="text" class="form-control" name="cur" id="cur" value="<?php echo $cur ?>" maxlength="20">
                                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo  $_SESSION['user']; ?>" hidden>
                                </div>

                                <button type="submit" id=recibiendo class="btn btn-info btn-block btn-round">confirmar</button>
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

    <hr>


    <footer>
        <small>&copy; Copyright 2022, GDJuarez</small>
    </footer>


    </div>


    </div>

    </div>
    <!-- Option 1: Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <!--   sweet alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>