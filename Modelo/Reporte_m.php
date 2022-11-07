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
    INNER JOIN movimiento_detalles ON movimiento_detalles.id_detalle = movimiento.ID
    INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_Vehiculo
    INNER JOIN personal ON personal.ID = movimiento.ID_Personal
    INNER JOIN producto ON producto.ID = movimiento.ID_Producto
    INNER JOIN empresa ON empresa.ID = movimiento.ID_Empresa
    WHERE movimiento.m_Fecha BETWEEN '$desde' AND '$hasta'; ")->fetch_all(MYSQLI_ASSOC);
    return $res;
  }
}
