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
									<h2 class="ml-lg-2 text-light">Empresa</h2>
								</div>
								<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
									<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" onclick="crear_empresa()">
										<i class="material-icons">&#xE147;</i>
										<span></span>
									</a>
									<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
										<i class="material-icons">&#xE15C;</i>
										<span></span>
									</a>
								</div>
							</div>
						</div>
						<!-- Tabla -->
						<table class="table table-striped table-hover" id="tabla">
							<thead>
								<th>ID</th>
								<th>Nombre de la empresa</th>
								<th>Rif de la empresa</th>
								<th>direccion de la empresa</th>
								<th>télefono de la empresa</th>
								<th>Nombre del encargado</th>
								<th>Cédula del encargado</th>
								<th>télefono del encargado</th>
								<th>dirección del encargado</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!-- fIN de la tabla -->
					</div>
				</div>
				<!----Formulario emergente--------->
				<form action="Controlador/Empresa.php" method="post">
					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Datos de la empresa</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Nombre de la empresa</label>
												<input type="text" name="Nombre" id="nombre" class="form-control" pattern="[A-Za-z ]+" title="Solo puedes ingresar caracteres alfabeticos" minlength="4" maxlength="20" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Rif de la empresa</label>
												<input type="text" name="Rif" id="rif" class="form-control" pattern="[0-9]+" title="Solo puedes ingresar caracteres númericos" minlength="8" maxlength="9" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Dirección de la empresa</label>
												<input type="text" name="Ubicacion" id="ubicacion" class="form-control" pattern="[A-Za-z0-9 ]+" title="Solo puedes ingresar caracteres alfabeticos y números" minlength="4" maxlength="50" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
											<label>Télefono de la empresa</label>
												<div class="input-group">
												<div class="pretend">
													<select name="codigo_area_e" id="codigo_area_e" class="form-control">
														<option value="0412">0412</option>
														<option value="0416">0416</option>
														<option value="0414">0414</option>
														<option value="0424">0424</option>
													</select>
												</div>
												<input type="text" name="Telefono" id="Telefono" class="form-control" pattern="[0-9]+" title="Solo puedes ingresar caracteres umericos" minlength="7" maxlength="7" required>
											</div>
												
												
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
											<label>Documento de identidad del encargado</label>
											<div class="input-group">
												<div class="pretend">
													<select name="tipoRif" id="tipo_rif" class="form-control">
														<option value="J">J</option>
														<option value="V">V</option>
													</select>
												</div>
												<input type="text" name="cedula_encargado" id="cedula_encargado" minlength="8" maxlength="10"  class="form-control" pattern="[0-9]+" title="Solo puedes ingresar caracteres númericos" required>
											</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Nombre del encargado</label>
												<input type="text" name="Encargado" id="encargado" class="form-control" pattern="[A-Za-z ]+" title="Solo puedes ingresar caracteres alfabeticos" minlength="4" maxlength="20" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Télefono del encargado</label>
												<div class="input-group">
												<div class="pretend">
													<select name="codigo_area" id="codigo_area" class="form-control">
														<option value="0412">0412</option>
														<option value="0416">0416</option>
														<option value="0414">0414</option>
														<option value="0424">0424</option>
													</select>
												</div>
												<input type="text" name="telefono_encargado" id="telefono_encargado" class="form-control" pattern="[0-9]{7}"  title="Solo puedes ingresar caracteres númericos" minlength="7" maxlength="7" required>
											</div>
												
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Dirección del encargado</label>
												<input type="text" name="direccion_encargado" id="direccion_encargado" class="form-control" pattern="[A-Za-z0-9 ]+" title="Solo puedes ingresar caracteres alfanumericos" minlength="4" maxlength="50" required>
											</div>
										</div>
									</div>
									
									
								</div>
								<div class="modal-footer">
									<input type="hidden" name="operacion" id="operacion" value="Registro">
									<input type="hidden" name="ID" id="id" class="ID">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="Registro" class="btn btn-success">Enviar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!----Eliminar Datos--------->
				<form action="Controlador/Empresa.php" method="post">
					<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Eliminar Registro</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>¿Está seguro de que desea eliminar este registro?</p>
									<p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<input type="hidden" name="ID" id="ID" class="ID">
									<input type="hidden" name="operacion" value="Eliminar">
									<button type="submit" name="Eliminar" class="btn btn-success">Eliminar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
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
		<script type="text/javascript">
			$(document).ready(() => {
				/* Creamos el datatable y por medio de la propiedad ajax, le damos la url a consultar y asignamos la propiedad dataSrc, le damos el valor data (ya que es lo que mando desde el controlador)
				 asigno las columnas donde van, y agrego los botones con su evento onclick para las operaciones
				 */
				$("#tabla").DataTable({
					"ajax": {
						"url": "Controlador/Empresa.php?operacion=ConsultarTodos",
						"dataSrc": "data"
					},
					"columns": [{
							data: "ID"
						},
						{
							data: "empresa_Nombre"
						},
						{
							data: "empresa_Rif"
						},
						{
							data: "empresa_Ubicacion"
						},
						{
							data: "empresa_Telefono"
						},
						{
							data: "empresa_Encargado"
						},
						{
							data: "empresa_CedulaE"
						},
						{
							data: "empresa_TelefonoE"
						},
						{
							data: "empresa_DireccionE"
						},
						{
							defaultContent: "",
							render(data, type, row) {
								let btn = `
									<a href="#addEmployeeModal" class="edit" data-toggle="modal" onclick="consultarUno('${row.ID}')">
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									</a>
									<a href="#deleteEmployeeModal" class="delete" id="delete" data-toggle="modal" onclick="Eliminar('${row.ID}')">
										<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
									</a>`;

								return btn;
							}
						}
					],
					language: {
						url: `Vista/js/DataTable.config.json`
					}
				})
			})
			/* 
				Basicamente definimos una variable consultarUno, donde almacenamoso una funcion, literalmente estoy creando una funcion de una manera difernte
				dentro de dicha funcion primero asigno la operacion que vamos a realizar (la de actualizar)	
				Luego hago uso de la funcion fetch para consultar al controlador por medio de js, piensa que es como usar ajax, bueno dicha peticion retorna, y 
				le asignamos que nos retorne un json (response.json()), luego nos response con un result (podemos colocar cualquier variable dentro, pero yo coloco un objeto
				para extraer lo que quiero directamente, osea la propiedad data, en dicha propiedad vienen los datos, en el controlador veras como esta esa parte)
			*/
			const consultarUno = async (id) => {
				$("#operacion").val("Actualizar");
				await fetch("Controlador/Empresa.php?operacion=ConsultarUno&&id=" + id)
					.then(response => response.json())
					.then(({
						data
					}) => {
						$("#id").val(data.ID)
						let [codigo,rif] = data.empresa_Rif.split("-")
						$("#rif").val(rif)
						$("#nombre").val(data.empresa_Nombre)
						$("#ubicacion").val(data.empresa_Ubicacion)
						let [codigoE, telefonoE] = data.empresa_Telefono.split("-")
						$("#codigo_area_e").val(codigoE)
						$("#Telefono").val(telefonoE)
						let [tipo, cedula] = data.empresa_CedulaE.split("-")
						$("#tipoRif").val(tipo)
						$("#cedula_encargado").val(cedula)
						$("#encargado").val(data.empresa_Encargado)
						$("#direccion_encargado").val(data.empresa_DireccionE)
						let [tipo2, telefono] = data.empresa_TelefonoE.split("-")
						$("#codigo_area").val(tipo2);
						$("#telefono_encargado").val(telefono);
						
						document.querySelectorAll("#condition").forEach(item => {
							if (item.value == data.empresa_condition) item.checked = true;
						})
					}).catch(error => console.error(error))
			}
			/* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
			const crear_empresa = () => $("#operacion").val("Registro")
			const Eliminar = (id) => $(".ID").val(id)
			/* El codigo de aqui abajo lo comente porque no le vi la utilidad, osea, lo comente y no vi cambios */
		</script>
</body>

</html>