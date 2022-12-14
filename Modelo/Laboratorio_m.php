<?php
require("Conexion.php");

class Laboratorio_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $muestra, $dano, $partido, $humedad, $impureza, $cantidad, $estatus;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id = $this->muestra = $this->dano = $this->partido = $this->humedad = $this->impureza = $this->cantidad = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($id, $muestra, $dano, $partido, $humedad, $impureza, $cantidad, $estatus)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->muestra = isset($muestra) ? $muestra : null;
    $this->dano = isset($dano) ? $dano : "NULL";
    $this->partido = isset($partido) ? $partido : "NULL";
    $this->humedad = isset($humedad) ? $humedad : "NULL";
    $this->impureza = isset($impureza) ? $impureza : "NULL";
    $this->cantidad = isset($cantidad) ? $cantidad : "NULL";
    $this->estatus_ope = isset($estatus) ? $estatus : "NULL";
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    session_start();
    try {
      
      if($this->impureza != "NULL") $pesolab = ($this->humedad + $this->impureza); else $pesolab = "NULL";

      // var_dump($this);
      // die("SSS");

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

      if ($this->estatus_ope == "NULL"){
        $ope = "U";
        $proceso = "R";
      }else{
        $ope = "A";
        $proceso = $this->estatus_ope;
      }

      $sql2 = "UPDATE movimiento SET status_proceso = '$proceso' WHERE ID = $this->id;";
      $result = $this->queryTransaccion($sql2);

      if (!$result) {
        $this->rollback();
        return false;
      }

      $idUsuario = $_SESSION['id_usuario_activo'];
      $sql3 = "INSERT INTO user_transaction_cambios(user_id, tran_id, des_cambio, fecha)
        VALUES($idUsuario, $this->id, '$ope',NOW())";

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

  public function Rechazo($id, $obser)
  {
    session_start();
    $sql = "UPDATE movimiento SET status_proceso = 'D', observacion = '$obser' WHERE ID = $id";
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
      empresa.empresa_Nombre,
      movimiento_detalles.*
      FROM movimiento
      INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_vehiculo
      INNER JOIN personal ON personal.ID = movimiento.ID_personal
      INNER JOIN producto ON producto.ID = movimiento.ID_producto
      LEFT JOIN empresa ON empresa.ID = movimiento.ID_empresa
      INNER JOIN movimiento_detalles ON movimiento.ID = movimiento_detalles.id_detalle ")->fetch_all(MYSQLI_ASSOC);
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
    $res = $this->ejecutar("SELECT 
    movimiento.*,
    movimiento_detalles.*,
    vehiculo.vehiculo_Placa,
    personal.personal_Cedula,
    personal.personal_Nacionalidad,
    producto.producto_Nombre,
    empresa.empresa_Nombre 
    FROM 
    movimiento 
    INNER JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID 
    INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_Vehiculo
    INNER JOIN personal ON personal.ID = movimiento.ID_Personal
    INNER JOIN producto ON producto.ID = movimiento.ID_Producto
    LEFT JOIN empresa ON empresa.ID = movimiento.ID_Empresa
    WHERE movimiento.ID = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $this->ejecutar("UPDATE entrada SET Estatus = false WHERE id = $this->id");
    return true;
  }
}
