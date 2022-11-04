<?php

    // DESCOMENTA ESTO SI EL LOGIN NO COOPERA
    // $this->clave_user = password_hash($this->clave_user, PASSWORD_BCRYPT, ['cost' => 12]);
    // $this->ejecutar("UPDATE usuarios SET clave_user = '$this->clave_user' WHERE cedula_user = '$this->cedula_user' ");
require("Conexion.php");

class Auth_m extends bd
{
  private $id, $cedula_user, $clave_user, $nombre, $rol_user, $estatus_user, $fecha_user, $tipo_user;

  public function __construct()
  {
    $this->id = $this->cedula_user = $this->clave_user = $this->nombre =
      $this->rol_user = $this->estatus_user =
      $this->fecha_user = $this->tipo_user = "";
  }

  public function SetDatos($datos)
  {
    $this->id = isset($datos['id']) ? $datos['id'] : null;
    $this->cedula_user = isset($datos['cedula_user']) ? $datos['cedula_user'] : null;
    $this->clave_user = isset($datos['clave']) ? $datos['clave'] : null;
    $this->nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
    $this->rol_user = isset($datos['rol']) ? $datos['rol'] : null;
    $this->estatus_user = isset($datos['estatus']) ? $datos['estatus'] : null;
    // $this->tipo_user = isset($datos['tipo_user']) ? $datos['tipo_user'] : null;

  }

  public function Loguear()
  {
    $sql = "SELECT * FROM usuarios WHERE cedula_user = '$this->cedula_user' ";
    $result1 = $this->ejecutar($sql)->fetch_assoc();

    if (!$result1) return 1;
    
    // if($result1['rol_user'] != "A"){
    //   if($result1['rol_user'] != $this->rol_user) echo "FUERA";
    // }
    
    if ($result1['estatus_user'] == 0) return 2;
    if (!password_verify($this->clave_user, $result1['clave_user'])){
      $result = $this->ejecutar("SELECT intentos_user FROM usuarios WHERE rol_user != 'A' AND cedula_user = '$this->cedula_user';")->fetch_assoc();
      $num = $result['intentos_user'];
      if($num){
        if($num == 2){
          $this->ejecutar("UPDATE usuarios SET estatus_user = 0 WHERE cedula_user = '$this->cedula_user';");
          return 4;
        }
      }

      $num =+ 1;
      $this->ejecutar("UPDATE usuarios SET intentos_user = $num WHERE cedula_user = '$this->cedula_user';");
      return 3;
    }

    session_start();
    $_SESSION['id_usuario_activo'] = $result1['id_usuario'];
    $_SESSION['cedula'] = $result1['cedula_user'];
    $_SESSION['rol_id'] = $result1['rol_user'];

    return 5;
  }

  public function Registrar()
  {
    $this->clave_user = password_hash($this->clave_user, PASSWORD_BCRYPT, ['cost' => 12]);
    $sql = "INSERT INTO usuarios(cedula_user, clave_user,nombre, rol_user, estatus_user, fecha_user)
     VALUES('$this->cedula_user','$this->clave_user','$this->nombre','$this->rol_user',1,NOW())";
    $result = $this->ejecutar($sql);
    if(!$result) die($sql);
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT id_usuario,cedula_user,nombre,rol_user,fecha_user,estatus_user FROM usuarios;");
    if($res) $res = $res->fetch_all(MYSQLI_ASSOC); else $res = [];
    return $res;
  }

  public function changeStatus(){
    $sql = "UPDATE usuarios SET estatus_user = $this->estatus_user WHERE rol_user != 'A' AND id_usuario = $this->id";
    $res = $this->ejecutar($sql);
    return $res;
  }
}
