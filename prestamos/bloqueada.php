<?php

session_start();

if($_SESSION['logged'] == 'yes' AND $_SESSION['roll'] <= '2')
{
	//echo 'Usuario: '.$_SESSION['user'];	
	 //echo "Usuario: ". $_SESSION['user']."</div>";
}else{
	
    echo '<script language=javascript>
      self.location = "../index.php"</script>';
}

//variables

$hoy = date("Y/m/d");   
$apellido='';
$curso='';
$ape='';
$cur='';
$disp_prestados=0;

//require database connection
require("../clases/class_conexion.php");
require("../clases/class_dispositivo.php");

// instancio  dispositivos y consulto funcion get
$mis_dispositivos = new Dispositivo();

$array_dispositivos=$mis_dispositivos->get_dispositivos();

$cant_registros=$mis_dispositivos->get_cantidad_registros();
/* 
foreach ($cant_registros as $reg) {
    # code...
    $cantidad_registros=$reg['total'];
}
 */

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

    <title>Bloquear</title>
    <!-- jquery-->
    <script  src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>

    <!-- js personalizado -->
    <script src="scriptBloqueada.js"></script>
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
                    <h1 class="text-white text-center">Bloqueos</h1>
                </div>
                <div class="col-lg-2">
               <p>usuario:  <?php echo $_SESSION['user'];?></p>
                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
                <a class="navbar-brand" href="#"></a>
             
                <form class="form-inline" action="menu.php" method="post">
                    <button class="btn btn-dark btn-sm" type="submit"><small>volver</small></button>
                </form>
                <form class="form-inline" action="../destruir.php" method="post">
                    <button class="btn btn-danger " type="submit"><small>cerrar sesion</small></button>
                </form>

            </nav>

        </div>
    </div>

</header>

<body>
    <div class='container bg-light border rounded '>
        <div class="row ">
            <div class="col-md-2">
               
            </div>
            <div class="col-md-8">

                    <table class="table table-sm table-responsive table-hover text-center" id="tablaPmo">

                        <tr class="Barra text-center >">
                            <th>Codigo</th>
                            <th>Dispo</th>
                            <th >Serial</th>
                            <th>#</th>
                            <th>Estado</th>                          
                            <th>Accion</th>
                         
                        </tr>

                        <?php 
                            
                                    foreach ($array_dispositivos as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['dispositivo']; ?></td>
                                        <td><?php echo $row['n_serial']; ?></td>
                                        <td><?php echo $row['numero']; ?></td>
                                        <?php  $estado=$row['estado'];
                                     
                                    if($estado == "disponible"){
                                        $boton_color= "class='btn btn-sm btn-success'";
                                    }elseif($estado == "BLOQUEADA"){
                                        $boton_color="class='btn btn-sm btn-dark' ";
                                      
                                    }else{
                                    $boton_color="class='btn btn-sm btn-danger' ";
                                    $disp_prestados +=1;
                                }
                                
                             ?>
                            <td><input type='submit' id='estado' <?php echo $boton_color ?>
                                    value='<?php echo $row['estado']?>' /></td>

                              <td><button type="button" class="btn btn-dark" id="bloquear" >BLOQ</button></td>
                                <td><button type="button" class="btn btn-success"id="disponible" >DISP</button></td>  
                          
                           

                            <td></td>
                            <td></td>
                        <?php  //cierro llaves del while
                          
                        }
                        //cierro conex
                        $mis_dispositivos->cerrar_conexion();
                        ?>
                     </table>

                     <?php if($disp_prestados==0){

                                echo " <div class='alert alert-success'>
                                <strong>Dispositivos Prestados: $disp_prestados </strong>  
                                </div>";

                                }else{

                                echo " <div class='alert alert-danger'>
                                <strong>Dispositivos Prestados:  $disp_prestados  </strong>  
                                </div>";
                                
                                } ?>

            </div>

            <div class="col-md-2"> 
              
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <!--   sweet alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    
</body>

</html>