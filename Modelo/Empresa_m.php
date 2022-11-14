<?php
require("Conexion.php");

class Empresa_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $encargado, $cedula_encargado, $telefono_encargado, $direccion_encargado, $rif, $nombre, $telefono, $ubicacion, $fecha;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id =
      $this->encargado =
      $this->cedula_encargado =
      $this->telefono_encargado =
      $this->direccion_encargado =
      $this->rif =
      $this->nombre =
      $this->ubicacion =
      $this->telefono =
      $this->fecha =
      $this->empresa_condition = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos(
    $id,
    $encargado,
    $cedula_encargado,
    $telefono_encargado,
    $direccion_encargado,
    $rif,
    $nombre,
    $ubicacion,
    $telefono
  ) {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->encargado = isset($encargado) ? $encargado : null;
    $this->cedula_encargado = isset($cedula_encargado) ? $cedula_encargado : null;
    $this->telefono_encargado = isset($telefono_encargado) ? $telefono_encargado : null;
    $this->direccion_encargado = isset($direccion_encargado) ? $direccion_encargado : null;
    $this->rif = isset($rif) ? $rif : null;
    $this->nombre = isset($nombre) ? $nombre : null;
    $this->ubicacion = isset($ubicacion) ? $ubicacion : null;
    $this->telefono = isset($telefono) ? $telefono : null;
    $this->fecha = date('m-d-Y');
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    $res = $this->ejecutar("SELECT * FROM empresa WHERE empresa_Rif = '$this->rif' OR empresa_Nombre = '$this->nombre';")->fetch_all(MYSQLI_ASSOC);
    if (isset($res[0])) return 5;

    $result = $this->ejecutar("INSERT INTO empresa(
      empresa_Rif,
      empresa_Encargado,
      empresa_cedulaE,
      empresa_telefonoE,
      empresa_direccionE,
      empresa_Nombre,
      empresa_Ubicacion,
      empresa_telefono,
      empresa_Estatus,
      empresa_Fecha) 
      VALUES ('$this->rif',
      '$this->encargado',
      '$this->cedula_encargado',
      '$this->telefono_encargado',
      '$this->direccion_encargado',
      '$this->nombre',
      '$this->ubicacion',
      '$this->telefono',
      true,NOW())");
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT * FROM empresa WHERE empresa_Estatus = true");
    if ($res) $res = $res->fetch_all(MYSQLI_ASSOC);
    else $res = [];
    return $res;
  }
  /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

  public function Actualizar()
  {
    $this->ejecutar("UPDATE empresa SET 
      empresa_Rif = '$this->rif',
      empresa_Encargado = '$this->encargado',
      empresa_cedulaE = '$this->cedula_encargado',
      empresa_telefonoE = '$this->telefono_encargado',
      empresa_direccionE = '$this->direccion_encargado',
      empresa_Nombre = '$this->nombre',
      empresa_Ubicacion = '$this->ubicacion',
      empresa_telefono = '$this->telefono'
    WHERE ID = $this->id");
    return true;
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM empresa WHERE ID = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $this->ejecutar("UPDATE empresa SET empresa_Estatus = false WHERE ID = $this->id");
    return true;
  }

  /* */

  public function Consultar_E()
  {
    $res = $this->ejecutar("SELECT * FROM empresa WHERE empresa_Estatus = false")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }

  public function Recuperar()
  {
    $this->ejecutar("UPDATE empresa SET empresa_Estatus = true WHERE id = $this->id");
    return true;
  }
}
