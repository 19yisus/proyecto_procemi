<script src="<?php $this->Assets('js/SweetAlert2.js'); ?>"></script>
<?php
if (isset($_GET['Mensaje'])) {
  if ($_GET['Mensaje'] == 1) {
    echo "<script>
              Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Datos Invalidos!',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
  if ($_GET['Mensaje'] == 2) {
    echo "<script>
              Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Usuario desactivado!',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
  if ($_GET['Mensaje'] == 3) {
    echo "<script>
              Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Contraseña incorrecta',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
  if ($_GET['Mensaje'] == 4) {
    echo "<script>
              Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Usuario desactivado',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
  if ($_GET['Mensaje'] == 5) {
    echo "<script>
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Login con exito!',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
}
