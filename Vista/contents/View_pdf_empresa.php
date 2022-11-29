<!-- Para empezar, optimice las lineas de codigo, y le di identacion al codigo para que se va mas ordenao y legible, como veras varias secciones de la pagina ya no estan.
	A estas secciones las estoy trabajando como componentes reutilizable, para no tener el mismo codigo repetido en todas las paginas -->
<!doctype html>
<html lang="en">
<?php
$this->Component("header");
include("Modelo/Conexion.php");
$a = new bd();
$empresa = $a->ejecutar("SELECT * FROM empresa WHERE empresa_Estatus = true");
?>

<body>
  <?php $this->Component("menu"); ?>
  <!------------>
  <!-----Contenido----------->
  <div id="content">
    <!------PANEL SUPERIOR----------->
    <?php $this->Component("navbar"); ?>
    <!------Tabla----------->
    <div class="main-content">
      <div class="row">
        <div class="col-md-12">
          <div class="table-wrapper">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                  <h2 class="ml-lg-2">Reportes de productos por Empresas</h2>
                </div>
              </div>
            </div>
            <form action="Controlador/Reporte.php" method="get" id="form_pdf">
              <div class="row col-10">
                <div class="col-4">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Empresa</label>
                      <select name="id_empresa" id="empresa" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <?php while ($a = $empresa->fetch_assoc()) { ?>
                          <option value="<?php echo $a["ID"]; ?>"><?php echo $a["empresa_Nombre"]; ?></option>
                        <?php } ?>
                      </select
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Desde</label>
                    <input type="date" name="desde" id="desde" required class="form-control">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Hasta</label>
                    <input type="date" name="hasta" id="hasta" required class="form-control">
                  </div>
                </div>
              </div>
              <div class="row col-10">
                <input type="hidden" name="operacion" id="operacion" value="ConsultarPorSilo">
                <button type="submit" class="btn btn-success mx-auto">
                  Enviar
                </button>
              </div>
            </form>

            <iframe src="" style="width:100%; height:500px; margin-top:10px; display:none;" id="visor_pdf" frameborder="1"></iframe>

          </div>
        </div>
      </div>
    </div>
    <!----Panel inferior------------->
    <footer class="footer">
      <div class="container-fluid">
        <div class="footer-in">
          <p class="mb-0">&copy 2021 Vishweb Design . All Rights Reserved.</p>
        </div>
      </div>
    </footer>
    <?php $this->Component("scripts"); ?>
    <script>
      document.getElementById("form_pdf").addEventListener("submit", (e) => {
        e.preventDefault();
        let empresa = $("#empresa").val()
        let operacion = $("#operacion").val()
        $("#visor_pdf").show(150)
        $("#visor_pdf").attr("src", `Controlador/Reporte.php?operacion=${operacion}&&id_empresa=${empresa}&&desde=${desde}&&hasta=${hasta}`)
      })
    </script>
</body>

</html>