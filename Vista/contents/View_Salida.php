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
									<h2 class="ml-lg-2">Salida</h2>
								</div>
							</div>
						</div>
						<!-- Tabla -->
						<table class="table table-striped table-hover" id="tabla">
							<thead>
								<th>ID</th>
								<th>Placa</th>
								<th>Cédula</th>
								<th>Empresa</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Peso Salida</th>
								<th>Cantidad Producto</th>
								<th>Silo</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!-- fIN de la tabla -->
					</div>
				</div>
				<!----Formulario emergente--------->
				<form action="Controlador/Salida.php" method="POST">
					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Salida</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<div class="modal-body">
									<div class="form-group">
										<label>Peso Salida</label>
										<input type="text" name="Peso" id="peso" class="form-control" required>
									</div>


									<div class="form-group">
										<input type="hidden" name="Cantidad" id="cantidad">
										<label>Silos</label>
										<select name="Silo" class="form-control">
											<option value="1">Silo 1</option>
											<option value="2">Silo 2</option>
											<option value="3">Silo 3</option>
											<option value="4">Silo 4</option>
										</select>
									</div>

								</div>
								<div class="modal-footer">
									<input type="hidden" name="ID" id="id">
									<input type="hidden" name="operacion" id="operacion" value="Registro">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="Registro" class="btn btn-success">Enviar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!----Panel inferior------------->
				<footer class="footer">
					<div class="container-fluid">
						<div class="footer-in">
							<p class="mb-0">&copy 2021 Vishweb Design . All Rights Reserved.</p>
						</div>
					</div>
				</footer>
				<?php $this->Component("scripts"); ?>
				<script type="text/javascript">
					$(document).ready(() => {
						/* Creamos el datatable y por medio de la propiedad ajax, le damos la url a consultar y asignamos la propiedad dataSrc, le damos el valor data (ya que es lo que mando desde el controlador)
						 asigno las columnas donde van, y agrego los botones con su evento onclick para las operaciones
						 */
						$("#tabla").DataTable({
							"ajax": {
								"url": "Controlador/Salida.php?operacion=ConsultarTodos",
								"dataSrc": "data"
							},
							"columns": [{
									data: "ID"
								},
								{
									data: "vehiculo_Placa"
								},
								{
									data: "personal_Cedula"
								},
								{
									data: "empresa_Nombre"
								},
								{
									data: "producto_Nombre"
								},
								{
									data: "m_Cantidad"
								},
								{
									data: "m_pesoFinal"
								},
								{
									data: "m_Total"
								},
								{
									data: "m_Silo"
								},
								{
									defaultContent: "",
									render(data, type, row) {
										let btn = `
									<a href="#addEmployeeModal" class="Delete" id="delete" data-toggle="modal" onclick="consultarUno('${row.ID}')">
									<i class="material-icons">&#xE147;</i>
									</a>
									`;
										return btn;
									}
								}
							],
						})
					})
					const consultarUno = async (id) => {
						$("#operacion").val("Registro");
						await fetch("Controlador/Salida.php?operacion=ConsultarUno&&id=" + id)
							.then(response => response.json())
							.then(({
								data
							}) => {
								$("#id").val(data.ID)
								$("#cantidad").val(data.m_Cantidad)
								$("#peso").val(data.m_PesoFinal)
							}).catch(error => console.error(error))
					}
					/* 
						Basicamente definimos una variable consultarUno, donde almacenamoso una funcion, literalmente estoy creando una funcion de una manera difernte
						dentro de dicha funcion primero asigno la operacion que vamos a realizar (la de actualizar)	
						Luego hago uso de la funcion fetch para consultar al controlador por medio de js, piensa que es como usar ajax, bueno dicha peticion retorna, y 
						le asignamos que nos retorne un json (response.json()), luego nos response con un result (podemos colocar cualquier variable dentro, pero yo coloco un objeto
						para extraer lo que quiero directamente, osea la propiedad data, en dicha propiedad vienen los datos, en el controlador veras como esta esa parte)
					
					/* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
					const Registro = (id) => $(".ID").val(id);
				</script>
</body>

</html>