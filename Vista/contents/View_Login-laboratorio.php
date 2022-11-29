<!DOCTYPE html>
<html>
<?php $this->Component("header"); ?>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="<?php $this->Assets('css/login.css'); ?>" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

  <div class="container">
    <div class="img">
      <img src="<?php $this->Assets('img/logo.png'); ?>" />
    </div>

    <div class="login-content">
      <form action="Controlador/Auth.php" method="POST">
        <input type="hidden" name="rol" value="L">
        <input type="hidden" name="operacion" value="Login">
        <img src="<?php $this->Assets('img/avatar.svg'); ?>" />

        <h2 class="title">Bienvenido</h2>
        <div class="input-div uno">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <h5>Cédula del usuario</h5>
            <input type="text" maxlength="8" minlength="7" pattern="[0-9]{7,8}" title="Solo se aceptan numeros" required class="input" name="cedula_user" id="cedula_user" />
          </div>
        </div>
        <div class="input-div uno">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">
            <h5>Contraseña</h5>
            <input type="password" maxlength="20" minlength="8" required class="input" name="clave_user" id="">
          </div>
        </div>
        <button type="submit" class="btn" value="Login">Aceptar<i class="fas fa-chevron-right"></i></button>
      </form>
    </div>
  </div>
  <?php $this->Component("alert_login"); ?>
  <?php $this->Component("scripts"); ?>
  <script type="text/javascript" src="<?php $this->Assets('js/login.js'); ?>"></script>
  <script tyoe="text/javascript">
     $("#cedula_user").on("input", function() {
      this.value = this.value.replace(/[^0-9]/g,'');
    })
  </script>
</body>