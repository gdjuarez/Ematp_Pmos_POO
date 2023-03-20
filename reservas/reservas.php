<?php

session_start();

if($_SESSION['logged'] == 'yes' AND $_SESSION['roll'] <= '4')
{
	$usuario= $_SESSION['user'];	
	
}else{
	
    echo '<script language=javascript>
    alert("No te has logeado, inicia sesion")
    self.location = "../index.php"</script>';
}


// Include database connection
include("../conexion/conexion.php");

// error_reporting(0);

$apellido='';

//************ */

$sql = mysqli_query($miConexion,"SELECT id, dispositivo,numero FROM  dispositivo where dispositivo <> 'netbook'");

// cantidad de registros
$cantidad_registros = mysqli_num_rows($sql);


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

    <title>Reservar</title>
    <!-- jquery-->
    <script   src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <!-- js personalizado -->
    <script src="scriptReserva.js"></script>
    <!-- css personalizado-->
    <link rel="../stylesheet" href="../stylefondo.css">
</head>

<header>
    <div class="container">
        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">Reservar Dispositivos</h1>
                </div>
                <div class="col-lg-2">
               <p>usuario:  <?php echo $_SESSION['user'];?></p>
                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
                <a class="navbar-brand" href="#"></a>
                <?php
                if($_SESSION['roll'] <= '2')
                {
                echo'<form class="form-inline " action="../prestamos/menu.php" method="post"><button class="btn btn-dark btn-sm " type="submit"><small>volver</small></button></form>';
                }
                ?>

                <form class="form-inline " action="gridReservas.php" method="post">
                    <button class="btn btn-outline-warning btn-sm " type="submit"><small>Listado de Reservas</small></button>
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
            <div class="col-md-1">
               
            </div>
            <div class="col-md-10">
               
                    <table class="table table-sm table-hover text-center" id="tablaPmo">

                        <tr class="sticky-top  text-center alert alert-secondary role='alert'>">
                            <th hidden>Codigo</th>
                            <th>Dispositivo</th>                       
                            <th>Numero</th>                       
                            <th>check</th>
                            <th>   <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_reserva"
                    id="modal_reserva" title="reserver"> reservar </button></th>
                        </tr>

                        <?php if ($sql!='') {

                            while($row = mysqli_fetch_assoc($sql)) { 
                               
                                $tid = $row['id'];
                                $tdispositivo= $row['dispositivo'];
                                $tnumero=$row['numero'];

                                ?>
                                    <tr>
                                        <td hidden><?php echo $tid ?></td>
                                        <td><?php echo $tdispositivo ?></td>                                      
                                        <td><?php echo $tnumero ?></td>                                     
                                        <td>
                                            <div class="form-check">                                            
                                                <input type="checkbox" id='check' class="case form-check-input" value="0">                                                
                                            </div>
                                        </td>
                        <?php  //cierro llaves del while
                            }
                        }
                        //cierro conex
                        mysqli_close($miConexion);
                        ?>
                     </table>

            </div>

            <div class="col-md-1"> 
                
                
                    <!-- ************************* M O D A L ***************************     -->
                    <!-- Trigger the modal with a button 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"
                    id="prestar" title="Ingresar"> retirar/devolver </button>  -->

                    <!-- Modal -->
                    <div class="modal fade" id="myModal_reserva" role="dialog">
                        <div class="modal-dialog modal-sm">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reservar de dispositivo</h5>
                                </div>

                                <div class="modal-body">
                                    <form action="#reservas.php" method="post">
                                                                          
                                        <div class="form-group">
                                        <label>usuario:</label>
                                                <input type="text" class="form-control" name="usuario" id="usuario"
                                                value="<?php echo  $_SESSION['user'];?>" readonly >
                                         </div>
                                         <div class="form-group">
                                            <label>Fecha a reservar:</label>
                                            <input type="date" class="form-control" id="fecha" 
                                                value="" requered>
                                                <div class="form-group">
                                            <label>Turno:</label>
                                            <select class="form-control" id="turno" required>
                                                <option selected value=""></option>
                                                <option value="1">Mañana</option>
                                                <option value="2">Tarde</option>
                                                <option value="3">Vespertino</option>
                                             </select>
                                             <label>Hora:</label>
                                            <select class="form-control" id="hora" required>
                                                <option selected value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>                                             
                                             </select>
                                             <label>Curso:</label>
                                            <select class="form-control"  id="curso" required>
                                                <option selected value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="AA">AA</option>
                                             </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Apellido:</label>
                                            <input type="text" class="form-control" id="apellido" 
                                                value="<?php echo $apellido ?>" maxlength="20">
                                        </div>
                                     

                                        <button type="submit" id=reservar class="btn btn-info btn-block btn-round">reservar</button>
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

    <div  class='respuesta'id='respuesta_update' hidden>


    </div>
    <hr>

<footer>
    <small>&copy; Copyright 2022, GDJuarez</small>
</footer>
    

   
    </div>
   
    </div>
    <!-- Option 1: Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
      <!--   sweet alert  -->
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>