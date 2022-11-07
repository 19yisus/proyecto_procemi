<!-- Para empezar, optimice las lineas de codigo, y le di identacion al codigo para que se va mas ordenao y legible, como veras varias secciones de la pagina ya no estan.
	A estas secciones las estoy trabajando como componentes reutilizable, para no tener el mismo codigo repetido en todas las paginas -->
  <!doctype html>
<html lang="en">
<?php $this->Component("header"); ?>

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
									<h2 class="ml-lg-2">Reportes de entrada</h2>
								</div>
								<!-- <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
									<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" onclick="crear_marca()">
										<i class="material-icons">&#xE147;</i>
										<span></span>
									</a>
								</div> -->
							</div>
						</div>
            <form action="Controlador/Reporte.php" method="post" target="__blank">
							<div class="row col-10">
								<div class="col-6">
									<div class="form-group">
										<label for="">Desde</label>
										<input type="date" name="desde" id="" required class="form-control">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="">Hasta</label>
										<input type="date" name="hasta" id="" required class="form-control">
									</div>
								</div>
							</div>
							<div class="row col-10">
								<input type="hidden" name="operacion" value="ConsultarTodos">
								<button type="submit" class="btn btn-success mx-auto">
									Enviar
								</button>
							</div>
						</form>
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
</body>

</html>