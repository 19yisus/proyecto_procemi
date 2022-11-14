<?php
require("Conexion.php");

class Personal_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $nombre, $apellido, $nacionalidad, $cedula, $telefono, $correo, $direccion, $empresa, $cargo, $condicion;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id = $this->nombre = $this->apellido = $this->nacionalidad = $this->cedula = $this->telefono = $this->correo = $this->direccion = $this->empresa = $this->cargo = $this->fecha = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($id, $nombre, $apellido, $nacionalidad, $cedula, $telefono, $correo, $direccion, $empresa, $cargo, $condicion)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->nombre = isset($nombre) ? $nombre : null;
    $this->apellido = isset($apellido) ? $apellido : null;
    $this->nacionalidad = isset($nacionalidad) ? $nacionalidad : null;
    $this->cedula = isset($cedula) ? $cedula : null;
    $this->telefono = isset($telefono) ? $telefono : null;
    $this->correo = isset($correo) ? $correo : null;
    $this->direccion = isset($direccion) ? $direccion : null;
    $this->empresa = isset($empresa) ? $empresa : "null";
    $this->cargo = isset($cargo) ? $cargo : "null";
    $this->condicion = isset($condicion) ? $condicion : null;
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    $res = $this->ejecutar("SELECT * FROM personal WHERE personal_Cedula = '$this->cedula';")->fetch_all(MYSQLI_ASSOC);
    if (isset($res[0]) && $res[0] != '') return 5;

    $sql = "INSERT INTO personal (
        personal_Cedula,
        personal_Nombre,
        personal_Apellido,
        personal_Nacionalidad,
        personal_Telefono,
        personal_Correo,
        personal_Direccion,
        personal_Estatus,
        personal_Fecha,
        personal_condicion,
        ID_Cargo,
        ID_Empresa) 
      VALUES (
        '$this->cedula',
        '$this->nombre',
        '$this->apellido',
        '$this->nacionalidad',
        '$this->telefono',
        '$this->correo',
        '$this->direccion',
        true,
        NOW(),
        '$this->condicion',
        $this->cargo,
        $this->empresa)";

    $result = $this->ejecutar($sql);
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT 
      personal.*,
      cargo.cargo_Nombre,
      empresa.empresa_Nombre
      FROM personal LEFT JOIN cargo ON cargo.ID = personal.ID_Cargo
      LEFT JOIN empresa ON empresa.ID = personal.ID_Empresa
      WHERE personal_Estatus = true");
    if ($res) $res = $res->fetch_all(MYSQLI_ASSOC);
    else $res = [];
    return $res;
  }
  /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

  public function Actualizar()
  {
    $res = $this->ejecutar("SELECT * FROM personal WHERE ID != $this->id AND personal_Cedula = '$this->cedula';")->fetch_all(MYSQLI_ASSOC);
    if (isset($res[0]) && $res[0] != '') return 5;

    $this->ejecutar("UPDATE personal SET 
      personal_Cedula = '$this->cedula',
      personal_Nombre = '$this->nombre',
      personal_Apellido = '$this->apellido',
      personal_Nacionalidad = '$this->nacionalidad',
      personal_Telefono = '$this->telefono',
      personal_Correo = '$this->correo',
      personal_Direccion = '$this->direccion',
      personal_condicion = '$this->condicion',
      ID_Cargo = $this->cargo,
      ID_Empresa = $this->empresa
      WHERE ID = $this->id");
    return true;
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM personal WHERE id = $id");
    if ($res) $res = $res->fetch_assoc();
    else $res = [];
    return $res;
  }

  public function ConsultarCedula($cedula)
  {
    $res = $this->ejecutar("SELECT * FROM personal WHERE personal_Cedula = $cedula");
    if ($res) $res = $res->fetch_assoc();
    else $res = [];
    return $res;
  }

  public function Eliminar()
  {
    $this->ejecutar("UPDATE personal SET personal_Estatus = false WHERE ID = $this->id");
    return true;
  }


  /* */

  public function Consultar_E()
  {
    $res = $this->ejecutar("SELECT 
      personal.ID, 
      personal.personal_Nombre, 
      personal.personal_Apellido,
      personal.personal_Nacionalidad,
      personal.personal_Cedula,
      personal.personal_Telefono,
      personal.personal_Correo,
      personal.personal_Direccion,
      cargo.cargo_Nombre,
      empresa.empresa_Nombre
      FROM personal INNER JOIN cargo ON cargo.ID = personal.ID_Cargo
      INNER JOIN empresa ON empresa.ID = personal.ID_Empresa
      WHERE personal_Estatus = false")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }

  public function Recuperar()
  {
    $this->ejecutar("UPDATE personal SET personal_Estatus = true WHERE id = $this->id");
    return true;
  }
}
