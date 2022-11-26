<?php
require("Conexion.php");

class Reporte_m extends bd
{
  public function Consultar_Todos($desde, $hasta)
  {
    $res = $this->ejecutar("SELECT
        movimiento.*,
        movimiento_detalles.*,
        personal.personal_Cedula,
        personal.personal_Nacionalidad,
        personal.personal_Nombre,
        personal.personal_Apellido,
        empresa.empresa_Nombre,
        vehiculo.vehiculo_Placa
    FROM
        movimiento
    left JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID
    left JOIN vehiculo ON vehiculo.ID = movimiento.ID_Vehiculo
    left JOIN personal ON personal.ID = movimiento.ID_Personal
    left JOIN producto ON producto.ID = movimiento.ID_Producto
    left JOIN empresa ON empresa.ID = movimiento.ID_Empresa
    WHERE movimiento.m_Silo != 'N' AND movimiento.m_Fecha BETWEEN '$desde' AND '$hasta'; ")->fetch_all(MYSQLI_ASSOC);

    $datos = [];
    foreach ($res as $mov) {
      $id = $mov['ID'];

      $result = $this->ejecutar("SELECT * FROM user_transaction_cambios 
        INNER JOIN usuarios ON usuarios.id_usuario = user_transaction_cambios.user_id
        WHERE user_transaction_cambios.tran_id = $id GROUP BY user_transaction_cambios.des_cambio;")->fetch_all(MYSQLI_ASSOC);

      array_push($datos, [
        'mov' => $mov,
        'cambios' => $result
      ]);
    }
    return $datos;
  }

  public function Consultar_PorSilo($silo)
  {
    $res = $this->ejecutar("SELECT
        movimiento.*,
        movimiento_detalles.*,
        personal.personal_Cedula,
        personal.personal_Nacionalidad,
        personal.personal_Nombre,
        personal.personal_Apellido,
        empresa.empresa_Nombre,
        vehiculo.vehiculo_Placa
    FROM
        movimiento
    LEFT JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID
    left JOIN vehiculo ON vehiculo.ID = movimiento.ID_Vehiculo
    left JOIN personal ON personal.ID = movimiento.ID_Personal
    LEFT JOIN producto ON producto.ID = movimiento.ID_Producto
    left JOIN empresa ON empresa.ID = movimiento.ID_Empresa
    WHERE movimiento.m_Silo = '$silo'; ")->fetch_all(MYSQLI_ASSOC);
    
    $datos = [];
    foreach ($res as $mov) {
      $id = $mov['ID'];

      $result = $this->ejecutar("SELECT * FROM user_transaction_cambios 
        INNER JOIN usuarios ON usuarios.id_usuario = user_transaction_cambios.user_id
        WHERE user_transaction_cambios.tran_id = $id GROUP BY user_transaction_cambios.des_cambio;")->fetch_all(MYSQLI_ASSOC);

      array_push($datos, [
        'mov' => $mov,
        'cambios' => $result
      ]);
    }
    return $datos;
  }

  public function Consultar_PorEstatus($status, $desde, $hasta)
  {
    $res = $this->ejecutar("SELECT
        movimiento.*,
        movimiento_detalles.*,
        personal.personal_Cedula,
        personal.personal_Nacionalidad,
        personal.personal_Nombre,
        personal.personal_Apellido,
        empresa.empresa_Nombre,
        vehiculo.vehiculo_Placa
    FROM
        movimiento
    LEFT JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID
    left JOIN vehiculo ON vehiculo.ID = movimiento.ID_Vehiculo
    left JOIN personal ON personal.ID = movimiento.ID_Personal
    LEFT JOIN producto ON producto.ID = movimiento.ID_Producto
    left JOIN empresa ON empresa.ID = movimiento.ID_Empresa
    WHERE movimiento.status_proceso = '$status' AND movimiento.m_Fecha BETWEEN '$desde' AND '$hasta';")->fetch_all(MYSQLI_ASSOC);
    
    $datos = [];
    foreach ($res as $mov) {
      $id = $mov['ID'];

      $result = $this->ejecutar("SELECT * FROM user_transaction_cambios 
        INNER JOIN usuarios ON usuarios.id_usuario = user_transaction_cambios.user_id
        WHERE user_transaction_cambios.tran_id = $id GROUP BY user_transaction_cambios.des_cambio;")->fetch_all(MYSQLI_ASSOC);

      array_push($datos, [
        'mov' => $mov,
        'cambios' => $result
      ]);
    }
    return $datos;
  }



  public function Consultar_Todos2($desde, $hasta)
  {
    $res = $this->ejecutar("SELECT
        movimiento.*,
        movimiento_detalles.*,
        personal.personal_Cedula,
        personal.personal_Nacionalidad,
        personal.personal_Nombre,
        personal.personal_Apellido,
        empresa.empresa_Nombre,
        vehiculo.vehiculo_Placa
    FROM
        movimiento
    left JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID
    left JOIN vehiculo ON vehiculo.ID = movimiento.ID_Vehiculo
    left JOIN personal ON personal.ID = movimiento.ID_Personal
    left JOIN producto ON producto.ID = movimiento.ID_Producto
    left JOIN empresa ON empresa.ID = movimiento.ID_Empresa
    WHERE movimiento.status_proceso = 'D' ")->fetch_all(MYSQLI_ASSOC);

    $datos = [];
    foreach ($res as $mov) {
      $id = $mov['ID'];

      $result = $this->ejecutar("SELECT * FROM user_transaction_cambios 
        INNER JOIN usuarios ON usuarios.id_usuario = user_transaction_cambios.user_id
        WHERE user_transaction_cambios.tran_id = $id GROUP BY user_transaction_cambios.des_cambio;")->fetch_all(MYSQLI_ASSOC);

      array_push($datos, [
        'mov' => $mov,
        'cambios' => $result
      ]);
    }
    return $datos;
  }
}
