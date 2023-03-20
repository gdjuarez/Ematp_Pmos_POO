<!DOCTYPE html>
<?php
   //incluimos el archivo encargado de mostrar los productos
   require("login.php");

   //Creamos una instancia de la  clase devuelve productos

     $usuarios = new Login();

     $array_usuarios=$usuarios->get_login();
?>
<html>

<head>
    <title>Hello!</title>
</head>

<body>

<?php

 //recorremos el array
           //la variable elemento contendrá los índices  

 foreach($array_usuarios as $elemento)
 {

     echo"<table><tr><td>";
     echo $elemento['id']."</td><td>";
      echo $elemento['user']."</td><td>";
       echo $elemento['pass']."</td><td>";
        echo $elemento['apellido_nombre']."</td><td>";
         echo $elemento['roll']."</td><td></<tr> </table>";

            echo "<br>";
             echo "<br>";


 }
?>


</body>
</html>