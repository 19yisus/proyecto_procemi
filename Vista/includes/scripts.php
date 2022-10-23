 <!--JavaScript -->
 <!-- Bootstrap JS -->
 <script src="<?php $this->Assets('js/jquery-3.3.1.slim.min.js'); ?>"></script>
 <script src="<?php $this->Assets('js/popper.min.js'); ?>"></script>
 <script src="<?php $this->Assets('js/bootstrap.min.js'); ?>"></script>
 <script src="<?php $this->Assets('js/jquery-3.3.1.min.js'); ?>"></script>
 <script src="<?php $this->Assets('DataTable/datatables.min.js'); ?>"></script>
 <script src="<?php $this->Assets('DataTable/DataTables-1.12.1/js/dataTables.bootstrap5.js'); ?>"></script>
 <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
 <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->
 <!-- Alertas -->
 <script src="<?php $this->Assets('js/SweetAlert2.js'); ?>"></script>
 <script type="text/javascript">
	$(document).ready(function() {
		$(".xp-menubar").on('click', function() {
			$("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		});

		$('.xp-menubar,.body-overlay').on('click', function() {
			$("#sidebar,.body-overlay").toggleClass('show-nav');
		});

	});
</script>

 <?php
  if (isset($_GET['Mensaje'])) {
    if ($_GET['Mensaje'] == 1) {
      echo "<script>
              Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Datos Invalidos',
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
                title: 'Registrados',
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
  }
  ?>