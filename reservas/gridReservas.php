<?php
session_start();

if($_SESSION['logged'] == 'yes' AND $_SESSION['roll'] <= '4')
{
	//echo 'Usuario: '.$_SESSION['user'];	
	 //echo "Usuario: ". $_SESSION['user']."</div>";
}else{
	
    echo '<script language=javascript>
    alert("No te has logeado, inicia sesion")
    self.location = "../index.php"</script>';
}

// Include database connection
include("../clases/class_conexion.php");
include("../clases/class_reservas.php");


$mis_Reservas = new Reserva();

$hoy= date('Y-m-d');
//echo $hoy;

//Variables

$m_primera='';
$m_segunda='';
$m_tercera='';
$m_cuarta='';
$m_poshora='';

$t_primera='';
$t_segunda='';
$t_tercera='';
$t_cuarta='';
$t_poshora='';

$v_primera='';
$v_segunda='';
$v_tercera='';
$v_cuarta='';
$v_prehora='';

$dia='';


if(isset( $_POST['fecha'])){

    $dia = $_POST['fecha'];
}else{
    $dia= $hoy;
}

if($dia!= ''){


    $listado=$mis_Reservas->get_reservas($dia);

    $cantidad_registros=count($listado);

    if ($cantidad_registros > 0) {

      
       foreach ($listado as $row)  {   
            $id = $row['id']; 
            $turno= $row['Turno'];          
            $dispositivo_id= $row['dispositivo_id']; 
            $dispositivo= $row['Dispositivo'];
            $fecha= $row['Fecha'];
            $hora= $row['Hora']; 
            $curso=$row['Curso']; 
            $profesor=$row['Profesor']; 
            $usuario=$row['usuario']; 
          // echo $hora.'-'.$dispositivo.' curso:'.$curso.' '.$profesor; 
          // echo "<br>";     

               if($turno == "1") {
               $turno="Mañana";
              
                    if($hora==1){
                        $m_primera.= $dispositivo.' curso:'.$curso.' '.$profesor;
                    }
                    if($hora==2){
                        $m_segunda.= $dispositivo.' curso:'.$curso.' '.$profesor;
                    }
                    if($hora==3){
                        $m_tercera.= $dispositivo.' curso:'.$curso.' '.$profesor;
                    }
                    if($hora==4){
                        $m_cuarta.= $dispositivo.' curso:'.$curso.' '.$profesor;
                    }
                    if($hora==5){
                        $m_poshora.= $dispositivo.' curso:'.$curso.' '.$profesor;
                        
                    }
               }
               if($turno == "2") {
                 $turno="Tarde";
                 if($hora==1){
                    $t_primera.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==2){
                    $t_segunda.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==3){
                    $t_tercera.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==4){
                    $t_cuarta.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==5){
                   $t_poshora.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }

                }
               if($turno == "3") {
                 $turno="Vespertino";
                 if($hora==1){
                    $v_primera.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==2){
                    $v_segunda.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==3){
                    $v_tercera.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==4){
                    $v_cuarta.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                if($hora==5){
                    $v_prehora.= $dispositivo.' curso:'.$curso.' '.$profesor;
                }
                 
                } 

        }
       
    }

   //cierro conex
  $mis_Reservas->cerrar_conexion();
        

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

    <title>Reservas</title>
    <!-- jquery-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <!-- css personalizado-->
    <link rel="stylesheet" href="../stylefondo.css">
</head>

<header>
    <div class="container bg-light">
        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">Reservas</h1>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="../img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
                <a class="navbar-brand" href="#"></a>

                <form class="form-inline" action="gridReservas.php" method="post">
                    <div class="form-group mb-2">
                        <input type="date" id='fecha' class="form-control form-control-sm text-center" name="fecha" value="" required>                      
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <button class="btn btn-primary" type="submit"><small>Ver fecha</small></button>
                    </div>
                </form>
                <form class="form-inline" action="printPDFreserva.php" method="post">
                    <div class="form-group mb-2">
                        <input type="date" id='fechareserva' class="form-control form-control-sm text-center" name="fechareserva" value="" required>                      
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <button class="btn btn-primary" type="submit"><small>imprimir ticket</small></button>
                    </div>
                </form>

                <form class="form-inline" action="../prestamos/menu.php" method="post">
                    <button class="btn btn-dark " type="submit"><small>volver</small></button>
                </form>
            </nav>
        </div>
    </div>
</header>

<body>
    <div class="container bg-light">
        <div class="row rounded">
            <div class='alert alert-secondary'>
            <?php
                $date_mostrar = new DateTime($dia);
                // echo $date_mostrar->format('d.m.Y'); // 18.11.2016
            ?>
                <strong> FECHA: <?php  echo $date_mostrar->format('d-m-Y'); ?></strong>               
            </div>
        </div>
        <div class="row rounded">
            <div class="col-sm  border ">
                <div class='alert alert-warning'>
                    <strong> TURNO MAÑANA - <?php echo $dia ?></strong>
                </div>
                <div class='alert alert-warning'>
                    <strong>Primera: <?php echo $m_primera ?></strong>
                </div>
                <div class='alert alert-warning'>
                    <strong>Segunda: <?php echo $m_segunda ?></strong>
                </div>
                <div class='alert alert-warning'>
                    <strong>Tercera: <?php echo $m_tercera ?></strong>
                </div>
                <div class='alert alert-warning'>
                    <strong>Cuarta: <?php echo $m_cuarta ?></strong>
                </div>
                <div class='alert alert-warning'>
                    <strong>Post-Hora: <?php echo $m_poshora ?></strong>
                </div>
            </div>
            <div class="col-sm  border ">
                <div class='alert alert-info'>
                    <strong> TURNO TARDE - <?php echo $dia ?></strong>
                </div>
                <div class='alert alert-info'>
                    <strong>Primera: <?php echo $t_primera ?></strong>
                </div>
                <div class='alert alert-info'>
                    <strong>Segunda: <?php echo $t_segunda ?></strong>
                </div>
                <div class='alert alert-info'>
                    <strong>Tercera: <?php echo $t_tercera ?></strong>
                </div>
                <div class='alert alert-info'>
                    <strong>Cuarta: <?php echo $t_cuarta ?></strong>
                </div>
                <div class='alert alert-info'>
                    <strong>Post-Hora: <?php echo $t_poshora ?></strong>
                </div>
            </div>
            <div class="col-sm  border ">
                <div class='alert alert-danger'>
                    <strong> TURNO VESPERTINO - <?php echo $dia ?></strong>
                </div>
                <div class='alert alert-danger'>
                    <strong>Primera: <?php echo $v_primera ?></strong>
                </div>
                <div class='alert alert-danger'>
                    <strong>Segunda: <?php echo $v_segunda ?></strong>
                </div>
                <div class='alert alert-danger'>
                    <strong>Tercera: <?php echo $v_tercera ?></strong>
                </div>
                <div class='alert alert-danger'>
                    <strong>Cuarta: <?php echo $v_cuarta ?></strong>
                </div>
                <div class='alert alert-danger'>
                    <strong>Pre-hora: <?php echo $v_prehora ?></strong>
                </div>
                <form class="form-inline" action="reservas.php" method="post">
                     <div class="form-group mx-sm-3 mb-2">
                        <button class="btn btn-primary btn-block" type="submit">Reservar</button>
                    </div>
                </form>
            </div>
           
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

</body>

</html>