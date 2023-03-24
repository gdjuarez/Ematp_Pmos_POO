<?php


//require ("../conexion/conexion.php");


class PrestamosLibros extends Conexion
{

  public function __construct()
  {

    parent::__construct();
  }

  public function create($titulo, $autor_editorial, $apellido, $curso, $cantidad, $fecha,$observ) {

    $sql = "INSERT INTO prestamo_libro (titulo,autor_editorial,apellido,curso,cantidad,fecha,observ) 
            values ('" . $titulo . "', '" . $autor_editorial . "', '".$apellido."','" . $curso . "','" . $cantidad . "', '" . $fecha . "', '" . $observ . "')";

    $res = mysqli_query($this->conexion_db, $sql);

    if ($res) {
      return true;
    } else {
      return false;
    }
  }

  public function update($id, $dispositivo, $serial, $numero)
  {

    $sql_disp = 'UPDATE dispositivo
			  SET dispositivo = "' . $dispositivo . '",
			  n_serial = "' . $serial . '",
			  numero = ' . $numero . '
			WHERE id = "' . $id . '"';

    $res = mysqli_query($this->conexion_db, $sql_disp);

    if ($res) {
      return true;
    } else {
      return false;
    }
  }


  public function get_libros_prestados($hoy){

    $resultado = $this->conexion_db->query('SELECT id,titulo,autor_editorial,apellido,curso,cantidad, date_format(fecha,"%d-%m-%Y") 
    as fecha,observ FROM prestamo_libro where fecha ="'.$hoy.'" ');

    $registro_libros = $resultado->fetch_all(MYSQLI_ASSOC);

    //pedimos que nos devuelva el array
    return $registro_libros;
  }



  public function cerrar_conexion()  {

    $this->conexion_db->close();
  }
}


?>


</body>

</html>