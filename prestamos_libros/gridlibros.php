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
require("../clases/class_PrestamosLibros.php");

//variables del modal
$tit='';
$aut='';
$ape='';
$cur='';
$can='';

$hoy = date("Y/m/d"); 

$gridlibros = new PrestamosLibros();

$array_libros=$gridlibros->get_libros_prestados($hoy);


// fecha y hora del servidor
$DateAndTime = date('m-d-Y h:i:s a', time());  
//echo "Fecha y Hora servidor:  $DateAndTime.";


?>


<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Alta de prestamo </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- fontawesome para icono -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
       <!-- jquery-->
       <script  src="https://code.jquery.com/jquery-1.12.4.min.js"
                integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                crossorigin="anonymous"></script>

       <link rel="stylesheet" href="stylefondo.css">
    
</head>

<header>
    <div class="container">
        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">                  
                   
                    <div id="volver">
                        <form action="../prestamos/menu.php" method="POST">
                            <input name="Enviar" type="submit" value="volver" class="btn btn-dark btn-sm" />
                        </form>
                    </div>

                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">Prestamos de Libros</h1>
                </div>
               
               
                <div class="col-lg-2">
                <div class="boton btn btn-info ">
                         <?php   echo "Fecha y Hora servidor:  $DateAndTime."  ?>
                    </div>
            
                </div>
            </div>

            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
              
                <a class="nav-item dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   ADMINISTRAR
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">                     
                    <a class="dropdown-item" href="gridlistado.php">LISTADO DE LIBROS PRESTADOS</a> 
                       
                    </div>                    
                    </a>
             
                <form class="form-inline" action="../destruir.php" method="post">
                    <button class="btn btn-outline-danger " type="submit"><small>cerrar sesion</small></button>
                </form>

            </nav>

        </div>
    </div>

</header>

<body>
    <div class='container bg-light rounded'>
    <div class="row">
            <div class="col-md-5">
            </div>
            <div class="col-md-2 ">
              <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#myModalR"
                            id="prestar" > Prestar Libros </button>
                            <hr>
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
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title">PRESTAR LIBROS</h5>
                                </div>

                                <div class="modal-body">
                                    <form action="prestar.php" method="post">

                                        <!-- dispositivo n_serianumero estado Apellido Curso -->
                                      
                                        <div class="form-group" >
                                            <label id='labelape'>TITULO:</label>
                                            <input type="text" class="form-control" name='titulo' id="titulo"
                                                value="<?php echo $tit ?>" maxlength="20">
                                        </div>
                                        <div class="form-group">
                                        <label id='labelape'>AUTOR/EDIT:</label>
                                            <input type="text" class="form-control" name='autor_editorial' id='autor_editorial'
                                                value="<?php echo $aut ?>" maxlength="20">                                           
                                        </div>
                                        <div class="form-group" >
                                            <label id='labelape'>APELLIDO:</label>
                                            <input type="text" class="form-control" name='apellido' id='apellido'
                                                value="<?php echo $ape ?>" maxlength="20">
                                        </div>
                                        <div class="form-group">
                                        <label id='labelape'>CURSO:</label>
                                            <input type="text" class="form-control" name='curso' id='curso'
                                                value="<?php echo $cur ?>" maxlength="20">                                           
                                        </div>
                                        <div class="form-group">
                                        <label id='labelape'>CANTIDAD:</label>
                                            <input type="text" class="form-control" name='cantidad' id='cantidad'
                                                value="<?php echo $can ?>" maxlength="20">                                           
                                        </div>

                                        <button type="submit" id=prestar class="btn btn-success m-4">confirmar</button>
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
            <div class="col-md-5">
            </div>
            </div>
    
    <div class='container bg-light rounded'>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="table-responsive-sm">
                    <form action="#" method="POST">
                        <!--                    -->
                        <table id="Tabla2" class="table table-hover text-center ">
                            <th>*</th>
                            <th>TITULO</th>
                            <th>AUTOR/EDIT</th>
                            <th>APELLIDO</th>
                            <th>CURSO</th>
                            <th>CANT</th>
                            <th>FECHA</th>
                            <th>observ.</th>
                            <th></th>

                        <?php  foreach ($array_libros as $detalle): 
                                $numero= $detalle['id']; 
                                $titulo= $detalle['titulo']; 
                                $autor_editorial= $detalle['autor_editorial']; 
                                $apellido= $detalle['apellido'];
                                $curso= $detalle['curso'];                              
                                $cantidad= $detalle['cantidad'];
                                $fecha= $detalle['fecha'];
                                $observ= $detalle['observ'];
                                ?>
                            <tr>
                                <td><?php echo $numero ?></td>
                                <td><?php echo $titulo ?></td>
                                <td><?php echo $autor_editorial ?></td>
                                <td><?php echo $apellido ?></td>
                                <td><?php echo $curso ?></td>
                                <td><?php echo $cantidad ?></td>
                                <td><?php echo $fecha ?></td>
                                <td><?php echo $observ ?></td>
                                <?php
                                if ($observ=='PRESTADO'){
                                    $boton='class="btn btn-danger"';
                                }else{
                                    $boton='class="btn btn-success"';
                                }
                                                                
                                ?>

                                <td>
                                    <div class="btn-group">
                                        <a href="devolucion.php?id=<?php echo  $numero?>" <?php echo  $boton?>
                                            title="Modificar estado"><i class="fas fa-marker"></i> </a>
                                    </div>
                                </td>
                            </tr>
                            <?php  endforeach  ?>
                        </table>
                        <br>
                        <!--                    -->
                    </form>

                </div>
                <hr>
                <footer>
                     <small>&copy; Copyright 2022, GDJuarez</small>
                </footer>
            </div>           
            <div class="col-md-2">
            </div>

        </div>
     
        </div>
      
    </div>
      <!-- Option 1: Bootstrap Bundle (includes Popper) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
  

</body>

</html>