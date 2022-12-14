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
      VALUES (
        '$this->rif',
      UPPER('$this->encargado'),
      '$this->cedula_encargado',
      '$this->telefono_encargado',
      UPPER('$this->direccion_encargado'),
      UPPER('$this->nombre'),
      UPPER('$this->ubicacion'),
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
    $res = $this->ejecutar("SELECT * FROM movimiento WHERE ID_Empresa = $this->id");
    $res = $res->fetch_assoc();
    if ($res != "" || $res != null) {
      return false;
    } else {
      $this->ejecutar("UPDATE empresa SET 
      empresa_Rif = '$this->rif',
      empresa_Encargado = UPPER('$this->encargado'),
      empresa_cedulaE = '$this->cedula_encargado',
      empresa_telefonoE = '$this->telefono_encargado',
      empresa_direccionE = UPPER('$this->direccion_encargado'),
      empresa_Nombre = UPPER('$this->nombre'),
      empresa_Ubicacion = UPPER('$this->ubicacion'),
      empresa_telefono = '$this->telefono'
      WHERE ID = $this->id");
      return true;
    }
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM empresa WHERE ID = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $res = $this->ejecutar("SELECT * FROM movimiento WHERE ID_Empresa = $this->id");
    $res = $res->fetch_assoc();
    if ($res != "" || $res != null) {
      return false;
    } else {
      $this->ejecutar("UPDATE empresa SET empresa_Estatus = false WHERE ID = $this->id");
      return true;
    }
  }

  //  Validaciones

  public function ConsultarEmpresa($nombre)
  {
    $res = $this->ejecutar("SELECT * FROM empresa WHERE empresa_Nombre = '$nombre'");
    if ($res) $res = $res->fetch_assoc();
    else $res = ["SELECT * FROM empresa WHERE empresa_Nombre = '$nombre'"];
    return $res;
  }

  public function ConsultarRif($rif)
  {
    $r = "J-" . $rif;
    $cedula = "E-" . $rif;

    // Empresa
    $res = $this->ejecutar("SELECT * FROM empresa WHERE (empresa_Rif = '$r') OR (empresa_cedulaE = '$r') OR (empresa_cedulaE = '$cedula')");
    $res = $res->fetch_assoc();

    // Persoanl
    $res2 = $this->ejecutar("SELECT * FROM personal WHERE personal_Cedula = '$rif'");
    $res2 = $res2->fetch_assoc();

    // Usuarios
    $res3 = $this->ejecutar("SELECT * FROM usuarios WHERE cedula_user = '$rif'");
    $res3 = $res3->fetch_assoc();

    // Vehiculo
    $res4 = $this->ejecutar("SELECT * FROM vehiculo WHERE (rif_dueno ='$r') OR (rif_dueno = '$cedula')");
    $res4 = $res4->fetch_assoc();



    switch (true) {
      case $res != "" || $res != null:
        return "El dato que estas ingresado ya esta registrado en otra empresa";
      case $res2 != "" || $res2 != null:
        return "El dato que estas ingresando ya esta registrado en un personal";
      case $res3 != "" || $res3 != null:
        return "El dato que estas ingresando ya esta registrado en un usuario del sistema";
      case $res4 != "" || $res4 != null:
        return "El dato que estas ingresando ya esta registrado en un vehiculo";
      default:
        return;
    }
  }

  public function ConsultarCedula($cedula)
  {
    $rif = "J-" . $cedula;
    $ced = "V-" . $cedula;

    // Empresa
    $res = $this->ejecutar("SELECT * FROM empresa WHERE (empresa_Rif = '$rif') OR (empresa_cedulaE = '$ced') OR (empresa_cedulaE = '$rif')");
    $res = $res->fetch_assoc();

    // Persoanl
    $res2 = $this->ejecutar("SELECT * FROM personal WHERE personal_Cedula = '$cedula'");
    $res2 = $res2->fetch_assoc();

    // Usuarios
    $res3 = $this->ejecutar("SELECT * FROM usuarios WHERE cedula_user = '$cedula'");
    $res3 = $res3->fetch_assoc();

    // Vehiculo
    $res4 = $this->ejecutar("SELECT * FROM vehiculo WHERE (rif_dueno ='$rif') OR (rif_dueno = '$ced')");
    $res4 = $res4->fetch_assoc();

    switch (true) {
      case $res != "" || $res != null:
        return "El dato que estas ingresado ya esta registrado en otra empresa";
      case $res2 != "" || $res2 != null:
        return "El dato que estas ingresando ya esta registrado en un personal";
      case $res3 != "" || $res3 != null:
        return "El dato que estas ingresando ya esta registrado en un usuario del sistema";
      case $res4 != "" || $res4 != null:
        return "El dato que estas ingresando ya esta registrado en un vehiculo";
      default:
        return;
    }
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
