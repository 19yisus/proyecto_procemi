<?php
  require ("Conexion.php");

  class Reporte_m extends bd{
    public function Consultar_Todos(){
        $res = $this->ejecutar("SELECT 
        movimiento.ID,
        movimiento.m_Cantidad,
        vehiculo.vehiculo_Placa,
        personal.personal_Cedula,
        producto.producto_Nombre,
        empresa.empresa_Nombre
        FROM movimiento
        INNER JOIN vehiculo ON vehiculo.ID = movimiento.ID_vehiculo
        INNER JOIN personal ON personal.ID = movimiento.ID_personal
        INNER JOIN producto ON producto.ID = movimiento.ID_producto
        INNER JOIN empresa ON empresa.ID = movimiento.ID_empresa
        WHERE m_Estatus = true")->fetch_all(MYSQLI_ASSOC);
        return $res;
    }
}