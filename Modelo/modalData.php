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
        <th scope="col">Nombre del Producto</th>
        <th scope="col">Peso neto</th>
        <th>Peso acondiciado al 12%</th>
        <th scope="col">Silo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $res['ID']; ?></th>
        <td><?php echo  $estatus_proceso; ?></td>
        <td><?php echo $condicion; ?></td>
        <td><?php echo $res['producto_Nombre']; ?></td>
        <td><?php echo $res['m_Cantidad'] . " KG.";; ?></td>
        <th></th>
        <td><?php echo $res['m_Silo']; ?></td>
      </tr>
    </tbody>
  </table>
  <strong>Detalles de la operación</strong>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Peso bruto</th>
        <th scope="col">GD</th>
        <th scope="col">GP</th>
        <th scope="col">Muestra</th>
        <th scope="col">Impureza</th>
        <th scope="col">Humedad</th>
        <th scope="col">Total de KG descontados</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $res['m_Cantidad'] . " KG."; ?></th>
        <td><?php echo $res['m_Dano']; ?></td>
        <td><?php echo $res['m_Partido']; ?></td>
        <td><?php echo $res['m_Muestra']; ?></td>
        <td><?php echo $res['m_Impureza'] . " %"; ?></td>
        <td><?php echo $res['m_Humedad'] . " %"; ?></td>
        <td><?php echo $res['m_PesoLab'] . " KG "; ?></td>
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
        <td><?php echo $res['segunda_Placa']; ?></td>
        <td><?php echo $res['vehiculo_Peso'] . "KG"; ?></td>
        <td><?php echo $res['Vehiculo_PesoSecundario'] . "KG"; ?></td>
        <?php if ($res['condicion'] == "P") { ?>
          <td><?php echo $res['rif_dueno']; ?></td>
        <?php } ?>
        <td><?php echo $res['vehiculo_Ano']; ?></td>
        <td><?php echo $res['modelo_Nombre']; ?></td>
        <td><?php echo $res['marca_Nombre']; ?></td>
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
        <td><?php echo $res['empresa_Nombre']; ?></td>
        <td><?php echo $res['empresa_Ubicacion']; ?></td>
      </tr>
    </tbody>
  </table>
  <!-- <strong>Usuarios involucrados</strong>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Cédula</th>
        <th scope="col">Rol</th>
        <th scope="col">Descripción de la operación</th>
      </tr>
    </thead>
    <tbody>
      <?php //while ($item = $res2->fetch_assoc()) { ?>
        <tr>
          <th scope="row"><?php //echo $item['cedula_user']; ?></th>
          <td><?php //echo $item['rol_user']; ?></td>
          <td><?php //echo $item['des_cambio']; ?></td>
        </tr>
      <?php //} ?>

    </tbody>
  </table> -->
</div>