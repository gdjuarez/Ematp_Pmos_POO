<?php

require("../clases/class_conexion.php");
require("../clases/class_PrestamosLibros.php");

//NO MUESTRA ERROR al cargar
//error_reporting(error_reporting() & ~E_NOTICE);

$gridlibros = new PrestamosLibros();


if (isset($_GET['id'])) {

  $numero = $_GET['id'];
  $actualizar = $gridlibros->update($numero);

  if ($actualizar) {

    echo '<script language=javascript>
                alert("DEVUELTO REGISTRADO")
                self.location = "gridlibros.php"</script>';
  } else {

    echo '<script language=javascript>
                alert("Hubo un error en el registro")
                self.location = "gridlibros.php"</script>';
  }
}
