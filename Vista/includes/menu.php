<div class="wrapper overflow-hidden">
  <div class="body-overlay"></div>
  <div id="sidebar">
    <div class="sidebar-header">
      <img src="<?php $this->Assets('img/logo.jpg'); ?>" class="img-fluid" width="150" />
      <h3><span>PROCEMI</span></h3>
      <h6>Usuario: <?php echo $_SESSION['cedula']; ?></h6>
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
        <a href="View_index" class="dashboard"><i class="material-icons">dashboard</i>Menu </a>
      </li>
      <?php if($_SESSION['rol_id'] != "L"){?>
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
              <li><a href="View_marca">Marca</a></li>
              <li><a href="View_modelo">Modelo</a></li>
              <li><a href="View_color">Color</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <?php }?>
      <li class="dropdown">
        <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="material-icons">apps</i>Movimiento
        </a>
        <ul class="collapse list-unstyled menu" id="homeSubmenu2">
          <?php if($_SESSION['rol_id'] != "L"){?>
          <li><a href="View_Entrada">Entrada Materia Prima</a></li>

          <?php 
            }
            if($_SESSION['rol_id'] == "L"){?>
          <li><a href="View_Laboratorio">Laboratorio</a></li>
          <?php 
            }
            if($_SESSION['rol_id'] != "L"){?>
          <li><a href="View_Salida">Salida</a></li>
          <?php }?>
        </ul>
      </li>
      <?php if($_SESSION['rol_id'] != "L"){?>
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
      <?php }?>
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