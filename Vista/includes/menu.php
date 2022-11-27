<div class="wrapper overflow-hidden">
  <div class="body-overlay"></div>
  <div id="sidebar">
    <div class="sidebar-header">
      <img src="<?php $this->Assets('img/logo.png'); ?>" class="img-fluid" width="150" />
      <h6>Usuario: <?php echo $_SESSION['Usuario']; ?></h6>
      <h6>
        Rol:
        <?php
        if ($_SESSION['rol_id'] == "A") echo "Administrador";
        if ($_SESSION['rol_id'] == "L") echo "Laboratorio";
        if ($_SESSION['rol_id'] == "R") echo "Romanero";
        ?>
      </h6>
    </div>
    <ul class="list-unstyled component m-0">
      <li class="active">
        <a href="View_index" class="dashboard"><i class="material-icons">dashboard</i>Inicio </a>
      </li>
      <?php if ($_SESSION['rol_id'] == "A") { ?>
        <li class="dropdown">
          <a href="View_usuarios">
            <i class="material-icons">
              settings_accessibility
            </i>Usuarios</a>
        </li>
      <?php } ?>

      <?php if ($_SESSION['rol_id'] == "L") { ?>
        <li class="dropdown">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">apps</i>Movimiento
          </a>
          <ul class="collapse list-unstyled menu" id="homeSubmenu1">
            <li><a href="View_Laboratorio">Laboratorio</a></li>
          </ul>
        </li>
      <?php } ?>

      <?php if ($_SESSION['rol_id'] == "R") { ?>
        <li class="dropdown">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">aspect_ratio</i>Registros
          </a>
          <ul class="collapse list-unstyled menu" id="homeSubmenu1">
            <li><a href="View_Personal">Personal</a></li>
            <li><a href="View_Vehiculo">Vehiculos</a></li>
            <li><a href="View_cargo">Cargo</a></li>
            <li><a href="View_Producto">Producto</a></li>
            <li><a href="View_Empresa">Empresa</a></li>
            <li>
              <a href="#homeSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Caracteristicas del vehiculo</a>
              <ul class="collapse list-unstyled menu" id="homeSubmenu5">
                <li><a href="View_marca">Marca</a></li>
                <li><a href="View_modelo">Modelo</a></li>
                <li><a href="View_color">Color</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#homeSubmenu9" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">aspect_ratio</i>Datos Eleminados
          </a>
          <ul class="collapse list-unstyled menu" id="homeSubmenu9">
            <li><a href="View_Personal_E">Personal</a></li>
            <li><a href="View_Cargo_E">Cargo</a></li>
            <li><a href="View_Producto_E">Producto</a></li>
            <li><a href="View_Empresa_E">Empresa</a></li>
            <a href="#homeSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Datos de vehiculos</a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu7">
              <li><a href="View_Vehiculo_E">Vehiculos</a></li>
              <li><a href="View_marca_E">Marca</a></li>
              <li><a href="View_modelo_E">Modelo</a></li>
              <li><a href="View_color_E">Color</a></li>
            </ul>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">apps</i>Movimiento
          </a>
          <ul class="collapse list-unstyled menu" id="homeSubmenu2">
            <li><a href="View_Entrada">Entrada Materia Prima</a></li>
            <li><a href="View_Salida">Salida</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="material-icons">equalizer</i>Reportes de sistema
          </a>
          <ul class="collapse list-unstyled menu" id="homeSubmenu3">
            <a href="#homeSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reportes de entrada</a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu7">
              <li><a href="View_pdf">Generar reporte de entradas </a></li>
              <li><a href="View_pdf2">Generar reporte de entradas rechazadas </a></li>
            </ul>
            <a href="#homeSubmenu8" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reportes de silos</a>
            <ul class="collapse list-unstyled menu" id="homeSubmenu8">
              <li><a href="View_pdf_silos">Generar reporte por silos</a></li>
            </ul>
          </ul>
        </li>
      <?php } ?>

      <li>
        <a href="#" onclick="cerrarSession()">
          <i class="material-icons">logout</i>Cerrar Sesión</a>
      </li>
    </ul>
  </div>

  <form action="Controlador/Auth.php" id="form_logout" method="POST">
    <input type="hidden" name="operacion" value="Logout">
    <input type="hidden" name="cedula_user" value="<?php $_SESSION['cedula']; ?>">
  </form>

  <script>
    const cerrarSession = () => document.getElementById("form_logout").submit();
  </script>