<?php
require("Conexion.php");

class Modelo_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $nombre, $fecha, $marca;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id = $this->nombre = $this->fecha = $this->marca = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($id, $nombre, $marca)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->nombre = isset($nombre) ? $nombre : null;
    $this->marca = isset($marca) ? $marca : null;
    $this->fecha = date('m-d-Y');
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    $sql = "INSERT INTO modelo(modelo_Nombre,modelo_Estatus,modelo_Fecha,ID_Marca) VALUES (UPPER('$this->nombre'),true,NOW(),$this->marca)";
    $result = $this->ejecutar($sql);
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT modelo.ID,modelo.modelo_Nombre,marca.marca_Nombre 
      FROM modelo INNER JOIN marca ON marca.ID = modelo.ID_Marca WHERE modelo_Estatus = true");
    if ($res) $res = $res->fetch_all(MYSQLI_ASSOC);
    else $res = [];
    return $res;
  }
  /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

  public function Actualizar()
  {
    $this->ejecutar("UPDATE modelo SET modelo_Nombre = '$this->nombre', ID_Marca = $this->marca WHERE id = $this->id");
    return true;
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM modelo WHERE id = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $this->ejecutar("UPDATE modelo SET modelo_Estatus = false WHERE id = $this->id");
    return true;
  }


  
  public function ConsultarModelo($nombre)
  {
    $res = $this->ejecutar("SELECT * FROM modelo WHERE modelo_Nombre = '$nombre'");
    if ($res) $res = $res->fetch_assoc();
    else $res = ["SELECT * FROM modelo WHERE modelo_Nombre = '$nombre'"];
    return $res;
  }



  /* */

  public function Consultar_E()
  {
    $res = $this->ejecutar("SELECT modelo.ID,modelo.modelo_Nombre,marca.marca_Nombre FROM modelo INNER JOIN marca ON marca.ID = modelo.ID_marca WHERE modelo_Estatus = false")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }

  public function Recuperar()
  {
    $this->ejecutar("UPDATE modelo SET modelo_Estatus = true WHERE id = $this->id");
    return true;
  }
}
