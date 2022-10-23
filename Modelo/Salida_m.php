<?php
require("Conexion.php");

class Salida_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $peso, $cantidad, $silo;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id =
      $this->peso =
      $this->cantidad =
      $this->silo = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($id, $peso, $cantidad, $silo)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->peso = isset($peso) ? $peso : null;
    $this->cantidad = isset($cantidad) ? $cantidad : null;
    $this->silo = isset($silo) ? $silo : null;
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    try {
      $sql1 = "UPDATE movimiento_detalles SET 
        m_pesoFinal = $this->peso, 
        m_Total = $this->cantidad - $this->peso
        WHERE id_detalle = $this->id";

      $con = $this->beginTransaccion();
      $result = $this->queryTransaccion($sql1);

      if (!$result) {
        $this->rollback();
        return false;
      }

      $sql2 = "UPDATE movimiento SET 
        status_proceso = 'S', m_Silo = '$this->silo' 
        WHERE ID = $this->id";

      $result = $this->queryTransaccion($sql2);

      if (!$result) {
        $this->rollback();
        return false;
      }

      $this->commit();
      return true;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT 
      movimiento.*,
      movimiento_detalles.*,
      vehiculo.vehiculo_Placa,
      personal.personal_Cedula,
      producto.producto_Nombre,
      empresa.empresa_Nombre
      FROM movimiento
      INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_vehiculo
      INNER JOIN personal ON personal.ID = movimiento.ID_personal
      INNER JOIN producto ON producto.ID = movimiento.ID_producto
      INNER JOIN empresa ON empresa.ID = movimiento.ID_empresa
      INNER JOIN movimiento_detalles ON movimiento.ID = movimiento_detalles.id_detalle
      WHERE m_PesoLab <> '' AND status_proceso = 'A' ")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }
  /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

  public function Actualizar()
  {
    $this->ejecutar("UPDATE movimiento SET m_PesoFinal='$this->peso' WHERE ID = $this->id");
    return true;
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM movimiento INNER JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID WHERE ID = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $this->ejecutar("UPDATE entrada SET Estatus = false WHERE id = $this->id");
    return true;
  }
}
