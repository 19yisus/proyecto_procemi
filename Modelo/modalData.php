<?php
if ($res['condicion_empresa'] == "E") $condicion = "Externa";
else $condicion = "Interna";

if ($res['status_proceso'] == "S") $estatus_proceso = "En el Silo";
if ($res['status_proceso'] == "R") $estatus_proceso = "Rechazado";
if ($res['status_proceso'] == "A") $estatus_proceso = "Aprobado por laboratorio";
if ($res['status_proceso'] == "R") $estatus_proceso = "En Revisión";
?>
<div class="row">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">estatus</th>
        <th scope="col">condición de la empresa</th>
        <th scope="col">Producto</th>
        <th scope="col">Silo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $res['ID']; ?></th>
        <td><?php echo  $estatus_proceso; ?></td>
        <td><?php echo $condicion; ?></td>
        <td><?php echo $res['producto_Nombre']; ?></td>
        <td><?php echo $res['m_Silo']; ?></td>
      </tr>
    </tbody>
  </table>
  <strong>Detalles de la operación</strong>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Cantidad</th>
        <th scope="col">GD</th>
        <th scope="col">GP</th>
        <th scope="col">Muestra</th>
        <th scope="col">Impureza</th>
        <th scope="col">Humedad</th>
        <th scope="col">Peso Lab</th>
        <th scope="col">Peso Final</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $res['m_Cantidad'] . " KG."; ?></th>
        <td><?php echo $res['m_Dano']; ?></td>
        <td><?php echo $res['m_Partido']; ?></td>
        <td><?php echo $res['m_Muestra']; ?></td>
        <td><?php echo $res['m_Impureza']; ?></td>
        <td><?php echo $res['m_Humedad']; ?></td>
        <td><?php echo $res['m_PesoLab'] . " KG."; ?></td>
        <td><?php echo ($res['m_pesoFinal']) ? $res['m_pesoFinal'] . " KG." : ""; ?></td>
        <td><?php echo $res['m_Total']; ?></td>
      </tr>
    </tbody>
  </table>
  <strong>Personal</strong>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Cédula</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Cargo</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Dirección</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $res['personal_Nacionalidad'] . "-" . $res['personal_Cedula']; ?></th>
        <td><?php echo $res['personal_Nombre']; ?></td>
        <td><?php echo $res['personal_Apellido']; ?></td>
        <td><?php echo $res['cargo_Nombre']; ?></td>
        <td><?php echo $res['personal_Telefono']; ?></td>
        <td><?php echo $res['personal_Correo']; ?></td>
        <td><?php echo $res['personal_Direccion']; ?></td>
      </tr>
    </tbody>
  </table>
  <strong>Vehiculo</strong>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Placa</th>
        <th scope="col">Segunda Placa</th>
        <th scope="col">Capacidad</th>
        <th scope="col">Segunda Capacidad</th>
        <?php if ($res['condicion'] == "P") { ?>
          <th>Rif del dueño</th>
        <?php } ?>
        <th scope="col">Año</th>
        <th scope="col">Modelo</th>
        <th scope="col">Marca</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $res['vehiculo_Placa']; ?></th>
        <td><?php echo ($res['segunda_Placa']) ? $res['segunda_Placa'] : "No tiene"; ?></td>
        <td><?php echo $res['vehiculo_Peso'] . "KG"; ?></td>
        <td><?php echo $res['Vehiculo_PesoSecundario'] . "KG"; ?></td>
        <?php if ($res['condicion'] == "P") { ?>
          <td><?php echo $res['rif_dueno']; ?></td>
        <?php } ?>
        <td><?php echo $res['vehiculo_Ano']; ?></td>
        <td><?php echo $res['modelo_Nombre']; ?></td>
        <td><p><?php echo $res['marca_Nombre']; ?></p></td>
      </tr>
    </tbody>
  </table>
  <strong>Empresa</strong>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Rif</th>
        <th scope="col">Encargado</th>
        <th scope="col">Nombre de la empresa</th>
        <th scope="col">Dirección</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $res['empresa_Rif']; ?></th>
        <td><?php echo $res['empresa_Encargado']; ?></td>
        <td><?php echo ($res['empresa_Nombre']) ? $res['empresa_Nombre'] : "Procemi"; ?></td>
        <td><p><?php echo $res['empresa_Ubicacion']; ?></p></td>
      </tr>
    </tbody>
  </table>
  
  <strong>Usuarios involucrados</strong>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Cédula</th>
        <th scope="col">Nombre</th>
        <th scope="col">Rol</th>
        <th scope="col">Descripción</th>
        <th scope="col">Fecha de la operación</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach($res2 as $item){
          if($item['des_cambio'] == 'E') $operacion = "Registro de Entrada";
          if($item['des_cambio'] == 'A') $operacion = "Aprobación";
          if($item['des_cambio'] == 'S') $operacion = "Asignado a un silo";
          if($item['des_cambio'] == 'U') $operacion = "Actualización del registro";
          if($item['des_cambio'] == 'D') $operacion = "Rechazado";

          if($item['rol_user'] == "R") $rol = "Romanero";
          if($item['rol_user'] == "L") $rol = "Laboratorio";
        ?>
        <tr>
          <th scope="row"><?php echo $item['cedula_user']; ?></th>
          <th><?php echo $item['nombre'];?></th>
          <td><?php echo $rol; ?></td>
          <td><?php echo $operacion; ?></td>
          <td><p><?php echo $item['fecha']; ?></p></td>
        </tr>
      <?php } ?>

    </tbody>
  </table>
</div>