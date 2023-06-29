<?php


    //require ("../conexion/conexion.php");


    class Usuario extends Conexion{

      private $usuario;
      private $pass;
      private $apellido_nombre;
      private $roll;

    public function __construct(){

     parent::__construct();
	   
    }
  
    public function create($usuario,$pass,$apellido_nombre,$roll){
      $this->usuario=$usuario;
      $this->pass=$pass;
      $this->apellido_nombre;
      $this->roll;
     
      $sql = 'INSERT INTO usuarios (user, pass, apellido_nombre, roll) 
      values ("'.($usuario).'", "'.($pass).'", "'.($apellido_nombre).'","'.$roll.'")';
     // echo $sql;
     
      $res = mysqli_query($this->conexion_db, $sql);
      
      if($res){
        return true;
      }else{
      return false;
     }
    }

    public function verificar_usuario($usuario){

      $this->usuario=$usuario;
     
      $resultado = $this->conexion_db->query('SELECT id,user,apellido_nombre FROM usuarios WHERE user="'.$usuario.'"');

       $reg_disp = $resultado->fetch_all(MYSQLI_ASSOC);

       //pedimos que nos devuelva el array
       return $reg_disp;

   }

   public function get_usuarios(){
     
    $resultado = $this->conexion_db->query("SELECT id,user,apellido_nombre FROM usuarios");

     $reg_disp = $resultado->fetch_all(MYSQLI_ASSOC);

     //pedimos que nos devuelva el array
     return $reg_disp;

  }
  


    public function delete($usuario){

      $this->usuario=$usuario;
     
      $reg_disp = $this->conexion_db->query("DELETE FROM usuarios WHERE user= '$usuario'");      

       //pedimos que nos devuelva el array
       return $reg_disp;

   }

    public function cerrar_conexion(){

        $this->conexion_db->close();
    }

    
    }

?>


</body>
</html>
