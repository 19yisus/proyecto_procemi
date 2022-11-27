<?php

use LDAP\Result;

require("Conexion.php");

class Color_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $nombre, $fecha;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id = $this->nombre = $this->fecha = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($id, $nombre)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->nombre = isset($nombre) ? $nombre : null;
    $this->fecha = date('m-d-Y');
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    $sql = "INSERT INTO color(color_Nombre,color_Estatus,color_Fecha) VALUES (UPPER('$this->nombre'),true,NOW())";
    $result = $this->ejecutar($sql);
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT * FROM color WHERE color_Estatus = true");
    if ($res) $res = $res->fetch_all(MYSQLI_ASSOC);
    else $res = [];
    return $res;
  }
  /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

  public function Actualizar()
  {
    $res = $this->ejecutar("SELECT * FROM vehiculo WHERE ID_Color = $this->id");
    $res = $res->fetch_assoc();
    if ($res != "" || $res != null) {
      return false;
    } else {
      $this->ejecutar("UPDATE color SET color_Nombre = '$this->nombre' WHERE ID = $this->id");
      return true;
    }
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM color WHERE ID = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $res = $this->ejecutar("SELECT * FROM vehiculo WHERE ID_Color = $this->id");
    $res = $res->fetch_assoc();
    if ($res != "" || $res != null) {
      return false;
    } else {
      $this->ejecutar("UPDATE color SET color_Estatus = false WHERE ID = $this->id");
      return true;
    }
  }

  public function ConsultarColor($nombre)
  {
    $res = $this->ejecutar("SELECT * FROM color WHERE color_Nombre = '$nombre'");
    if ($res) $res = $res->fetch_assoc();
    else $res = ["SELECT * FROM color WHERE color_Nombre = '$nombre'"];
    return $res;
  }


  /* */

  public function Consultar_E()
  {
    $res = $this->ejecutar("SELECT * FROM color WHERE color_Estatus = false")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }

  public function Recuperar()
  {
    $this->ejecutar("UPDATE color SET color_Estatus = true WHERE id = $this->id");
    return true;
  }
}
