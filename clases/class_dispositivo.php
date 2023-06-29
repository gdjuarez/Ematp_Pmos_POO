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

    $this->dispositivo = $dispositivo;
    $this->serial = $serial;
    $this->numero = $numero;
    $this->estado = $estado;
    $this->Apellido = $Apellido;
    $this->curso = $curso;

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
    $this->estado=$estado;
    $this->id=$id;

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

    $this->estado=$estado;
    $this->id=$id;

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

  // getters  and setters 

  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of dispositivo
   */ 
  public function getDispositivo()
  {
    return $this->dispositivo;
  }

  /**
   * Set the value of dispositivo
   *
   * @return  self
   */ 
  public function setDispositivo($dispositivo)
  {
    $this->dispositivo = $dispositivo;

    return $this;
  }

  /**
   * Get the value of serial
   */ 
  public function getSerial()
  {
    return $this->serial;
  }

  /**
   * Set the value of serial
   *
   * @return  self
   */ 
  public function setSerial($serial)
  {
    $this->serial = $serial;

    return $this;
  }

  /**
   * Get the value of numero
   */ 
  public function getNumero()
  {
    return $this->numero;
  }

  /**
   * Set the value of numero
   *
   * @return  self
   */ 
  public function setNumero($numero)
  {
    $this->numero = $numero;

    return $this;
  }

  /**
   * Get the value of estado
   */ 
  public function getEstado()
  {
    return $this->estado;
  }

  /**
   * Set the value of estado
   *
   * @return  self
   */ 
  public function setEstado($estado)
  {
    $this->estado = $estado;

    return $this;
  }

  /**
   * Get the value of Apellido
   */ 
  public function getApellido()
  {
    return $this->Apellido;
  }

  /**
   * Set the value of Apellido
   *
   * @return  self
   */ 
  public function setApellido($Apellido)
  {
    $this->Apellido = $Apellido;

    return $this;
  }

  /**
   * Get the value of curso
   */ 
  public function getCurso()
  {
    return $this->curso;
  }

  /**
   * Set the value of curso
   *
   * @return  self
   */ 
  public function setCurso($curso)
  {
    $this->curso = $curso;

    return $this;
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