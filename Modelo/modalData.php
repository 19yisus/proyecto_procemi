<?php
if ($res['condicion_empresa'] == "E") $condicion = "Externa";
else $condicion = "Procemi";

if ($res['status_proceso'] == "S") $estatus_proceso = "En el Silo";
if ($res['status_proceso'] == "D") $estatus_proceso = "Rechazado por laboratorio";
if ($res['status_proceso'] == "A") $estatus_proceso = "Aprobado por laboratorio";
if ($res['status_proceso'] == "R") $estatus_proceso = "En Revisión";
if ($res['status_proceso'] == "P") $estatus_proceso = "Por analizar";

if ($res['segunda_Placa'] == null) $segunda_Placa = "No tiene";
else $segunda_Placa = $res["segunda_Placa"];

if ($res['Vehiculo_PesoSecundario'] == 0) $segundo_Peso = "No tiene";
else $segundo_Peso = $res['Vehiculo_PesoSecundario']; 

if ($res['m_Cantidad'] == "") $muestra = "No ingresada";
else $muestra = $res['m_Cantidad'] . "KG";

if ($res['m_Dano'] == "")$daño = "Sin analizar";
else $daño = $res['m_Dano'] . "%";

if ($res['m_Partido']=="")$partido = "Sin analizar";
else $partido = $res['m_Partido'] . "%";

if ($res['m_Muestra'] == "")$muestra = "Sin ingresar";
else $muestra = $res['m_Muestra'] . "KG";

if ($res['m_Impureza'] == "")$impureza = "Sin analizar";
else $impureza = $res['m_Impureza'] . "%";

if ($res['m_Humedad'] == "")$humedad = "sin analizar";
else $humedad = $res['m_Humedad'] . "%";

if ($res['m_Desc_Humedad'] == "")$descHumedad = "sin analizar";
else $descHumedad = $res['m_Desc_Humedad'] . "KG";

if ($res['m_Desc_Impureza'] == "")$descImpureza = "sin analizar";
else $descImpureza = $res['m_Desc_Impureza'] . "KG";

if ($res['m_TotalDesc'] == "")$totalDesc = "sin analizar";
else $totalDesc = $res['m_TotalDesc'] . "KG";

if ($res['m_PesoAcon'] == "")$pesoAcon = "Sin analizar";
else $pesoAcon = $res['m_PesoAcon'] . "KG";

if ($res['m_Silo']=='N')$silo = "Sin almacenar";
else $silo = $res['m_Silo'];

?>
<div class="row">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Fecha</th>
        <th scope="col">ID</th>
        <th scope="col">estatus</th>
        <th scope="col">condición de la empresa</th>
        <th scope="col">Nombre del Producto</th>
        <th>Peso acondiciado al 12%</th>
        <th scope="col">Silo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th><?php echo $res['m_Fecha']?>;</th>
        <th><?php echo $res['ID']; ?></th>
        <td><?php echo  $estatus_proceso; ?></td>
        <td><?php echo $condicion; ?></td>
        <td><?php echo $res['producto_Nombre']; ?></td>
        <td><?php echo $pesoAcon?></td>
        <td><?php echo $silo ?></td>
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
        <th scope="col">Desc. por humedad</th>
        <th scope="col">desc. por impureza</th>
        <th scope="col">Total de KG descontados</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row"><?php echo $muestra ?></th>
        <td><?php echo $daño ?></td>
        <td><?php echo $partido ?></td>
        <td><?php echo $muestra?></td>
        <td><?php echo $impureza?></td>
        <td><?php echo $humedad?></td>
        <td><?php echo $descHumedad ?></td>
        <td><?php echo $descImpureza ?></td>
        <td><?php echo $totalDesc ?></td>

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
        <td>
          <?php
          echo $segunda_Placa;
          ?>
        </td>

      

      | <?php if ($res['condicion'] == "P") { ?>
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
      <?php //while ($item = $res2->fetch_assoc()) { 
      ?>
        <tr>
          <th scope="row"><?php //echo $item['cedula_user']; 
                          ?></th>
          <td><?php //echo $item['rol_user']; 
              ?></td>
          <td><?php //echo $item['des_cambio']; 
              ?></td>
        </tr>
      <?php //} 
      ?>

    </tbody>
  </table> -->
</div>