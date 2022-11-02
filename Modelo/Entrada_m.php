<?php
require("Conexion.php");

class Entrada_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $id_vehiculo, $id_personal, $id_empresa, $id_producto, $cantidad, $estatus, $fecha, $condicion_empresa;
  private $dano, $muestra, $humedad, $impureza, $pesoLab, $pesoFinal, $total;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id =
      $this->id_vehiculo =
      $this->id_personal =
      $this->id_empresa =
      $this->id_producto =
      $this->cantidad =
      $this->estatus =
      $this->condicion_empresa =
      $this->fecha = "";
    $this->dano = "";
    $this->muestra = "";
    $this->humedad = "";
    $this->impureza = "";
    $this->pesoLab = "";
    $this->pesoFinal = "";
    $this->total = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($d)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($d['ID']) ? $d['ID'] : null;
    $this->id_vehiculo = isset($d['id_vehiculo']) ? $d['id_vehiculo'] : null;
    $this->id_personal = isset($d['id_personal']) ? $d['id_personal'] : null;
    $this->id_empresa = isset($d['id_empresa']) ? $d['id_empresa'] : "NULL";
    $this->condicion_empresa = isset($d['condicion_empresa']) ? $d['condicion_empresa'] : null;
    $this->id_producto = isset($d['id_producto']) ? $d['id_producto'] : null;
    $this->estatus = isset($d['estatus']) ? $d['estatus'] : null;
    $this->fecha = date('m-d-Y');

    if (isset($d['segunda_cantidad'])) {
      $this->cantidad = (intval($d['cantidad']) + intval($d['segunda_cantidad']));
    } else $this->cantidad = isset($d['cantidad']) ? $d['cantidad'] : null;

    $this->dano = isset($d['dano']) ? $d['dano'] : null;
    $this->muestra = isset($d['muestra']) ? $d['muestra'] : null;
    $this->humedad = isset($d['humedad']) ? $d['humedad'] : null;
    $this->impureza = isset($d['impureza']) ? $d['impureza'] : null;
    $this->pesoLab = isset($d['pesoLab']) ? $d['pesoLab'] : null;
    $this->pesoFinal = isset($d['pesoFinal']) ? $d['pesoFinal'] : null;
    $this->total = isset($d['total']) ? $d['total'] : null;
  }
  //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
  //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
  public function Registrar()
  {
    session_start();
    try {
      $sql1 = "INSERT INTO movimiento(
          ID_Vehiculo, ID_Personal,
          ID_Producto, ID_Empresa,condicion_empresa,
          
          m_Silo, m_Estatus,status_proceso,m_Fecha) 
          VALUES (
          $this->id_vehiculo,$this->id_personal,$this->id_producto,$this->id_empresa,'$this->condicion_empresa',
          'N',1,'R',NOW()
          )";

      $con = $this->beginTransaccion();
      $result = $this->queryTransaccion($sql1);

      if (!$result) {
        $this->rollback();
        die($sql1);
        return false;
      }

      $id_mov = $this->ultimoID();

      $sql2 = "INSERT INTO movimiento_detalles(
          id_detalle,
          m_Cantidad, m_Dano, m_Partido, m_Muestra, m_Humedad,
          m_Impureza, m_PesoLab, m_PesoFinal, m_Total) 
        VALUES (
          '$id_mov',
          '$this->cantidad',null,null,null,null,null,null,null,null)";
      $result = $this->queryTransaccion($sql2);

      if (!$result) {
        $this->rollback();
        die($sql2);
        return false;
      }

      $idUsuario = $_SESSION['id_usuario_activo'];
      $sql3 = "INSERT INTO user_transaction_cambios(user_id, tran_id, des_cambio, fecha)
        VALUES($idUsuario, $id_mov, 'E',NOW())";

      $result = $this->queryTransaccion($sql3);

      if (!$result) {
        $this->rollback();
        die($sql3);
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
      empresa.empresa_Nombre,
      producto.producto_Nombre
      FROM movimiento
      INNER JOIN movimiento_detalles ON movimiento.ID = movimiento_detalles.id_detalle
      INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_vehiculo
      INNER JOIN personal ON personal.ID = movimiento.ID_personal
      INNER JOIN producto ON producto.ID = movimiento.ID_producto
      LEFT JOIN empresa ON empresa.ID = movimiento.ID_empresa
      WHERE m_Estatus = true")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }

  public function consultModal($id)
  {
    $sql = "SELECT 
    movimiento.*,
    movimiento_detalles.*,
    vehiculo.vehiculo_Placa,
    vehiculo.segunda_Placa,
    vehiculo.rif_dueno,
    vehiculo.vehiculo_Peso,
    vehiculo.vehiculo_Ano,
    vehiculo.condicion,
    vehiculo.if_doble,
    vehiculo.Vehiculo_PesoSecundario,
    modelo.modelo_Nombre,
    marca.marca_Nombre,
    personal.personal_Cedula,
    personal.personal_Nombre,
    personal.personal_Apellido,
    personal.personal_Nacionalidad,
    personal.personal_Telefono,
    personal.personal_Correo,
    personal.personal_Direccion,
    cargo.cargo_Nombre,
    empresa.empresa_Nombre,
    empresa.empresa_Rif,
    empresa.empresa_Encargado,
    empresa.empresa_Ubicacion,
    producto.producto_Nombre
    FROM movimiento
    INNER JOIN movimiento_detalles ON movimiento.ID = movimiento_detalles.id_detalle
    INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_vehiculo
    INNER JOIN modelo ON modelo.ID = vehiculo.ID_Modelo
    INNER JOIN marca ON marca.ID = modelo.ID_Marca
    INNER JOIN personal ON personal.ID = movimiento.ID_personal
    INNER JOIN cargo ON cargo.ID = personal.ID_Cargo
    INNER JOIN producto ON producto.ID = movimiento.ID_producto
    LEFT JOIN empresa ON empresa.ID = movimiento.ID_empresa
    WHERE movimiento.ID = $id";
    $res = $this->ejecutar($sql)->fetch_assoc();

    $sql2 = "SELECT * FROM user_transaction_cambios 
    INNER JOIN usuarios ON usuarios.id_usuario = user_transaction_cambios.user_id
    WHERE tran_id = $id";

    $res2 = $this->ejecutar($sql);

    require_once "modalData.php";
    
  }
  /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

  public function Actualizar()
  {
    session_start();
    try {
      $sql1 = "UPDATE movimiento SET 
      ID_Vehiculo = $this->id_vehiculo,
      ID_Personal = $this->id_personal,
      ID_Empresa = $this->id_empresa,
      ID_Producto = $this->id_producto,
      status_proceso = 'R'
      WHERE ID = $this->id";
      $con = $this->beginTransaccion();
      $result = $this->queryTransaccion($sql1);

      if (!$result) {
        $this->rollback();
        var_dump($sql1);
        die("ss");
        return false;
      }

      $sql2 = "UPDATE movimiento_detalles SET m_Cantidad = $this->cantidad WHERE id_detalle = $this->id";
      $result = $this->queryTransaccion($sql2);

      if (!$result) {
        $this->rollback();
        var_dump($sql2);
        die("xx");
        return false;
      }

      $idUsuario = $_SESSION['id_usuario_activo'];
      $sql3 = "INSERT INTO user_transaction_cambios(user_id, tran_id, des_cambio, fecha)
        VALUES($idUsuario, $this->id, 'U',NOW())";

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
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM movimiento INNER JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID WHERE id = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $this->ejecutar("UPDATE movimiento SET m_Estatus = false WHERE ID = $this->id");
    return true;
  }


  /* */

  public function Consultar_E()
  {
    $res = $this->ejecutar("SELECT 
      movimiento.ID,
      movimiento.m_Cantidad,
      movimiento.m_Dano,
      movimiento.m_Muestra,
      movimiento.m_Humedad,
      movimiento.m_Impureza,
      movimiento.m_PesoFinal,
      movimiento.m_Silo,
      vehiculo.vehiculo_Placa,
      personal.personal_Cedula,
      producto.producto_Nombre,
      empresa.empresa_Nombre
      FROM movimiento
      INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_vehiculo
      INNER JOIN personal ON personal.ID = movimiento.ID_personal
      INNER JOIN producto ON producto.ID = movimiento.ID_producto
      INNER JOIN empresa ON empresa.ID = movimiento.ID_empresa
      WHERE m_Estatus = false")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }

  public function Recuperar()
  {
    $this->ejecutar("UPDATE movimiento SET m_Estatus = true WHERE id = $this->id");
    return true;
  }
}
