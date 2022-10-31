<?php
require("Conexion.php");

class Laboratorio_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $muestra, $dano, $partido, $humedad, $impureza, $cantidad;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id = $this->muestra = $this->dano = $this->partido = $this->humedad = $this->impureza = $this->cantidad = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($id, $muestra, $dano, $partido, $humedad, $impureza, $cantidad)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->muestra = isset($muestra) ? $muestra : null;
    $this->dano = isset($dano) ? $dano : null;
    $this->partido = isset($partido) ? $partido : null;
    $this->humedad = isset($humedad) ? $humedad : null;
    $this->impureza = isset($impureza) ? $impureza : null;
    $this->cantidad = isset($cantidad) ? $cantidad : null;
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    session_start();
    try {
      $pesolab = ($this->cantidad - $this->impureza) - $this->humedad;

      $sql1 = "UPDATE movimiento_detalles SET 
        m_Muestra = $this->muestra,
        m_Dano = $this->dano,
        m_Partido = $this->partido,
        m_Humedad = $this->humedad,
        m_Impureza = $this->impureza,
        m_PesoLab = $pesolab
        WHERE id_detalle = $this->id;";
      $con = $this->beginTransaccion();
      $result = $this->queryTransaccion($sql1);

      if (!$result) {
        $this->rollback();
        die($sql1);
        return false;
      }

      $sql2 = "UPDATE movimiento SET status_proceso = 'A' WHERE ID = $this->id;";

      $result = $this->queryTransaccion($sql2);

      if (!$result) {
        $this->rollback();
        return false;
      }

      $idUsuario = $_SESSION['id_usuario_activo'];
      $sql3 = "INSERT INTO user_transaction_cambios(user_id, tran_id, des_cambio, fecha)
        VALUES($idUsuario, $this->id, 'A',NOW())";

      $result = $this->queryTransaccion($sql3);

      if (!$result) {
        $this->rollback();
        return false;
      }

      $this->commit();
      return true;
    } catch (Exception $e) {
      die($e->getMessage());
    }
    $this->ejecutar("");
    return true;
  }

  public function Rechazo($id)
  {
    session_start();
    $sql = "UPDATE movimiento SET status_proceso = 'D' WHERE ID = $id";
    $result = $this->ejecutar($sql);

    $idUsuario = $_SESSION['id_usuario_activo'];
    $sql3 = "INSERT INTO user_transaction_cambios(user_id, tran_id, des_cambio, fecha)
        VALUES($idUsuario, $id, 'R',NOW())";

    $result = $this->ejecutar($sql3);

    if (!$result) {
      $this->rollback();
      return false;
    }
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT 
      movimiento.*,
      vehiculo.vehiculo_Placa,
      personal.personal_Cedula,
      producto.producto_Nombre,
      movimiento_detalles.*
      FROM movimiento
      INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_vehiculo
      INNER JOIN personal ON personal.ID = movimiento.ID_personal
      INNER JOIN producto ON producto.ID = movimiento.ID_producto
      INNER JOIN movimiento_detalles ON movimiento.ID = movimiento_detalles.id_detalle
      WHERE m_Estatus = true AND status_proceso = 'R' ")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }
  /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

  public function Actualizar()
  {
    $this->ejecutar("UPDATE movimiento SET m_Muestra='$this->muestra',m_Humedad='$this->humedad',m_Impureza='$this->impureza' WHERE ID = $this->id");
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
