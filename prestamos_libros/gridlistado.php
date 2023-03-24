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

$fecha='';

$dia = date("Y/m/d"); 

if(isset( $_POST['fecha'])){
    $dia = $_POST['fecha'];
}else{
    $dia = date("Y/m/d");   
}

$gridlibros = new PrestamosLibros();

$array_libros=$gridlibros->get_libros_prestados($dia);

?>


<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Listado </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- fontawesome para icono -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="stylefondo.css">

</head>

<header>
    <div class='container'>
        <nav class="navbar navbar-light rounded text-center" style="background-color: #FF5733;">
            <!-- Navbar content -->
            <div id="volver">
                <form action="gridlibros.php" method="POST">
                    <input name="Enviar" type="submit" value="volver" class="btn btn-secondary btn-sm" />
                </form>
            </div>
            <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">

            <a href="#" class="navbar-brand text-white">
                <h2>Listado de Prestamos</h2>
            </a>
            <form class="form-inline my-2 my-lg-0" action="gridlistado.php" method="post">
                         <input type="date" id='fecha' class="form-control form-control-sm text-center"  name="fecha" value="<?php echo  $fecha ?>">
                         <button class="btn btn-primary " type="submit"><small>listar</small></button>
                </form>
            <form action="../destruir.php" method="POST" class="form-inline">
                <button class="btn btn-danger my-2 my-sm-0" type="submit">usuario :
                    <?php echo $_SESSION['user']?> <br> cerrar-sesion</button>
            </form>
        </nav>
        <br>
</header>

<body>
    <div class='container bg-light'>
  

        <div class="row">
            <div class="col-md-12">
                <div id="chequeo">
                    <form action="#" method="POST">
                        <!--                    -->
                        <table id="Tabla" class="table table-sm">
                            <th>*</th>
                            <th>TITULO</th>
                            <th>AUTOR/EDIT</th>
                            <th>APELLIDO</th>
                            <th>CURSO</th>
                            <th>CANTIDAD</th>
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
                                    $boton='class="btn btn-outline-danger"';
                                }else{
                                    $boton='class="btn btn-success"';
                                }
                                                                
                                ?>

                                <td>
                                    <div class="btn-group">
                                        <a href="#" <?php echo  $boton?>></a>
                                    </div>
                                </td>
                            </tr>

                            <?php  endforeach  ?>

                        </table>
                        <br>
                        <!--                    -->
                    </form>

                </div>
            </div>

        </div>
        <hr>

        <footer>
            <small>&copy; Copyright 2022, GDJuarez</small>
        </footer>
    </div>

</body>

</html>