<?php 
//
 ?>
 

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--fontawesome icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Prestamos</title>
    <!-- jquery --> 
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="stylefondo.css">


</head>

<body>
    <div class="container container-sm">
      

        <div class="banner  rounded" style="background-color: #FF5733 ;">
            <div class="row">
                <div class="col-lg-2">
                  
                </div>
                <div class="col-lg-8">
                    <h1 class="text-white text-center">E.E.S n°1</h1>
                </div>
                <div class="col-lg-2">
                   
                </div>
            </div>
            <nav class="navbar navbar-light bg-white border rounded">
                <!-- Navbar content -->
                <img src="img/escudo1.png" class="rounded " style="width:5%" alt="Responsive image">
                <a class="navbar-brand" href="#"></a>
                <h1>Prestamos Dispositivos Tecnologicos</h1>

                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#myModal_sesion"
                    id="inicio_sesion" title="Ingresar"> Iniciar sesion </button>
            </nav>

        </div>

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
                        <h5 class="modal-title"></h5>
                    </div>

                    <div class="modal-body">
                        <form action="conexion/login.php" method="post">
                            <div class="form-group">
                                <label>Usuario:</label>
                                <input type="text" class="form-control" id="user" name="user" placeholder="Usuario..."
                                    maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" id="pass" name="pass"
                                    placeholder="contraseña..." maxlength="20" required>
                            </div>
                            <button type="submit" class="btn btn-info btn-block btn-round">Ingresar</button>
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


        <div class="container bg-light border rounded">
            <br>
            <div class="row">
                <div class="col-sm-4">
                </div>

                <div class="col-sm-4">

                    <div class="comunicado bg-light border rounded text-center">
                    <img src="img/escudo1.png" class="rounded" style="width:85%" alt="Responsive image">
                       
                    </div>



                    <div class="text-white rounded" style="background-color: #395586;">
                        <p align="center">Escuela de Educación Secundaria n°1</p>
                        <p align="center">calle 47 esq. 30, Mercedes (B) </p>
                    </div>

                    <footer>
                        <HR>
                        <small>© Copyright 2022, GDJuarez (Ematp Informatica)</small>
                    </footer>

                </div>


                <div class="col-sm-4">
                </div>
            </div>


            <!-- Option 1: Bootstrap Bundle (includes Popper) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
                crossorigin="anonymous">
            </script>


</body>

</html>