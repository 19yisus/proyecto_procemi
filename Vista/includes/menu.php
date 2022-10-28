<div class="wrapper overflow-hidden">
  <div class="body-overlay"></div>
  <div id="sidebar">
    <div class="sidebar-header">
      <h1><img src="<?php $this->Assets('img/logo.jpg'); ?>" class="img-fluid" /><span>PROCEMI</span></h1>
    </div>
    <ul class="list-unstyled component m-0">
      <li class="active">
        <a href="View_index" class="dashboard"><i class="material-icons">dashboard</i>Menu </a>
      </li>
      <li class="dropdown">
        <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="material-icons">aspect_ratio</i>Registros
        </a>
        <ul class="collapse list-unstyled menu" id="homeSubmenu1">
          <li><a href="View_Personal">Personal</a></li>
          <li><a href="View_Vehiculo">Camiones</a></li>
          <li><a href="View_cargo">Cargo</a></li>
          <li><a href="View_Producto">Producto</a></li>
          <li><a href="View_Empresa">Empresa</a></li>
          <li>
            <a href="#homeSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Configuración del vehículo</a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu5">
          </li>
          <li><a href="View_marca">Marca</a></li>
          <li><a href="View_modelo">Modelo</a></li>
          <li><a href="View_color">Color</a></li>
        </ul>

    </ul>
    </li>
    <li class="dropdown">
      <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="material-icons">apps</i>Movimiento
      </a>
      <ul class="collapse list-unstyled menu" id="homeSubmenu2">
        <li><a href="View_Entrada">Entrada Materia Prima</a></li>
        <li><a href="View_Laboratorio">Laboratorio</a></li>
        <li><a href="View_Salida">Salida</a></li>
      </ul>
    </li>

    <li class="dropdown">
      <a href="#homeSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="material-icons">aspect_ratio</i>Datos Eliminados
      </a>
      <ul class="collapse list-unstyled menu" id="homeSubmenu4">
        <li><a href="personal_E.php">Personal</a></li>
        <li><a href="View_Vehiculo_E">Camiones</a></li>
        <li><a href="Cargo_E.php">Cargo</a></li>
        <li><a href="Producto_E.php">Producto</a></li>
        <li><a href="Empresa_E.php">Empresa</a></li>
        <li><a href="Color_E.php">Color</a></li>
        <li><a href="Marca_E.php">Marca</a></li>
        <li><a href="Modelo_E.php">Modelo</a></li>
        <li><a href="Entrada_E.php">Entrada</a></li>
        <li>
      </ul>
    </li>


    <li class="dropdown">
      <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="material-icons">equalizer</i>Reportes de sistema
      </a>
      <ul class="collapse list-unstyled menu" id="homeSubmenu3">
        <li><a href="reportes_entrada.php">Todod los maestros y ovimientos </a></li>
      </ul>
    </li>
    </ul>
  </div>