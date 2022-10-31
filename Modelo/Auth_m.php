<?php
require("Conexion.php");

class Auth_m extends bd
{
  private $id, $cedula_user, $clave_user, $rol_user, $estatus_user, $fecha_user, $tipo_user;

  public function __construct()
  {
    $this->id = $this->cedula_user = $this->clave_user =
      $this->rol_user = $this->estatus_user =
      $this->fecha_user = $this->tipo_user = "";
  }

  public function SetDatos($datos)
  {
    $this->id = isset($datos['id']) ? $datos['id'] : null;
    $this->cedula_user = isset($datos['cedula_user']) ? $datos['cedula_user'] : null;
    $this->clave_user = isset($datos['clave']) ? $datos['clave'] : null;
    $this->rol_user = isset($datos['rol']) ? $datos['rol'] : null;
    $this->estatus_user = isset($datos['estatus']) ? $datos['estatus'] : null;
    // $this->tipo_user = isset($datos['tipo_user']) ? $datos['tipo_user'] : null;
  }

  public function Loguear()
  {
    $sql = "SELECT * FROM usuarios WHERE cedula_user = '$this->cedula_user' ";
    $result1 = $this->ejecutar($sql)->fetch_assoc();

    if (!$result1) return 1;
    if($result1['rol_user'] != "A"){
      if($result1['rol_user'] != $this->rol_user) echo "FUERA";
    }
    
    if ($result1['estatus_user'] == 0) return 2;
    if (!password_verify($this->clave_user, $result1['clave_user'])) return 3;

    session_start();
    $_SESSION['cedula'] = $result1['cedula_user'];
    $_SESSION['rol_id'] = $result1['rol_user'];

    return 5;
  }

  public function Registrar()
  {
    $this->clave_user = password_hash($this->clave_user, PASSWORD_BCRYPT, ['cost' => 12]);
    $sql = "INSERT INTO usuarios(cedula_user, clave_user, rol_user, estatus_user, fecha_user)
     VALUES('$this->cedula_user','$this->clave_user','$this->rol_user',1,NOW())";
    $result = $this->ejecutar($sql);
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT id_usuario,cedula_user,rol_user,fecha_user,estatus_user FROM usuarios WHERE estatus_user = 1;");
    if($res) $res = $res->fetch_all(MYSQLI_ASSOC); else $res = [];
    return $res;
  }
}
