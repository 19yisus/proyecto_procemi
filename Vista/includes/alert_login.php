<script src="<?php $this->Assets('js/SweetAlert2.js'); ?>"></script>
<?php
if (isset($_GET['Mensaje'])) {
  if ($_GET['Mensaje'] == 1) {
    echo "<script>
              Swal.fire({
                position: 'top-end',
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
                position: 'top-end',
                icon: 'success',
                title: 'Usuario desactivado!',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
  if ($_GET['Mensaje'] == 3) {
    echo "<script>
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Eliminado',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
  if ($_GET['Mensaje'] == 4) {
    echo "<script>
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Recuperado',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
  if ($_GET['Mensaje'] == 5) {
    echo "<script>
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Login con exito!',
                showConfirmButton: false,
                timer: 1500
              })
            </script>";
  }
}
