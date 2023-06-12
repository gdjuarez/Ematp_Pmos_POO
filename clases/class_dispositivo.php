<?php


//require ("../conexion/conexion.php");


class Dispositivo extends Conexion {

  private $id;
  private $dispositivo;
  private $serial;
  private $numero;
  private $estado;
  private $Apellido;
  private $curso;

  public function __construct()
  {

    parent::__construct();
  }


  public function create($dispositivo, $serial, $numero, $estado, $Apellido, $curso)  {

    // Escapar los valores para evitar inyección SQL
    $dispositivo = $this->conexion_db->real_escape_string($dispositivo);
    $serial = $this->conexion_db->real_escape_string($serial);
    $numero = $this->conexion_db->real_escape_string($numero);
    $estado = $this->conexion_db->real_escape_string($estado);
    $Apellido = $this->conexion_db->real_escape_string($Apellido);
    $curso = $this->conexion_db->real_escape_string($curso);

    $sql = "INSERT INTO dispositivo (dispositivo,n_serial,numero,estado,Apellido,Curso) 
            values ('" . $dispositivo . "', '" . $serial . "', '.$numero.','" . $estado . "', '" . $Apellido . "', '" . $curso . "')";

    $res = mysqli_query($this->conexion_db, $sql);

    if ($res) {
      return true;
    } else {
      return false;
    }
  }

  public function update($id, $dispositivo, $serial, $numero) {

    $this->id = $id;
    $this->dispositivo = $dispositivo;
    $this->serial = $serial;
    $this->numero = $numero;

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

  public function get_disp($id)  {

    $this->id = $id;

    $resultado = $this->conexion_db->query("SELECT id, dispositivo, n_serial, numero ,estado, Apellido, Curso FROM dispositivo  where id =$id");

    $reg_disp = $resultado->fetch_all(MYSQLI_ASSOC);

    //pedimos que nos devuelva el array
    return $reg_disp;
  }


  public function get_dispositivos()  {

    $resultado = $this->conexion_db->query('SELECT id, dispositivo, n_serial, numero,estado,Apellido,Curso FROM  dispositivo');

    $registro_disp = $resultado->fetch_all(MYSQLI_ASSOC);

    //pedimos que nos devuelva el array
    return $registro_disp;
  }

  public function get_cantidad_registros()  {

    $resultado = $this->conexion_db->query('SELECT COUNT(*) total  FROM  dispositivo');

    $cant_registro = $resultado->fetch_all(MYSQLI_ASSOC);

    //pedimos que nos devuelva el array
    return $cant_registro;
  }

  public function update_prestado( $estado,$apellido,$curso,$id) {

    $this->id = $id;
    $this->estado = $estado;
    $this->Apellido = $apellido;
    $this->curso = $curso;

    $sql_disp = 'UPDATE dispositivo
          SET estado = "'.$estado.'",
          Apellido = "'.$apellido.'",
          Curso = "'.$curso.'"
        WHERE id = "'.$id.'"';
    // echo $sql_disp;
    $res_estado = mysqli_query($this->conexion_db, $sql_disp);

    if ($res_estado) {
      return true;
    } else {
      return false;
    }
  }

  public function update_recibido( $estado,$id) {

    $sql_disp = 'UPDATE dispositivo
              SET estado = "'.$estado.'",
              Apellido = "",
              Curso = ""
            WHERE id = "'.$id.'"';
    // echo $sql_disp;
    $res_estado = mysqli_query($this->conexion_db, $sql_disp);

    if ($res_estado) {
      return true;
    } else {
      return false;
    }
  }

  public function updateEstado($id, $estado)  {

    $sql_disp = 'UPDATE dispositivo
						  SET estado = "' . $estado . '"
						WHERE id = "' . $id . '"';
    // echo $sql_disp;
    $res_estado = mysqli_query($this->conexion_db, $sql_disp);

    if ($res_estado) {
      return true;
    } else {
      return false;
    }
  }

  public function cerrar_conexion()  {

    $this->conexion_db->close();
  }
}

?>

<?php

//Creamos una instancia de la  clase devuelve 

/*   $mis_dispositivos = new Dispositivo();

     $array_dispositivos=$mis_dispositivos->get_dispositivos();

 foreach($array_dispositivos as $elemento) { } 
 */


?>


</body>

</html>