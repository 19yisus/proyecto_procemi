<?php
include("Modelo/Conexion.php");
$a = new bd();
$cargo = $a->ejecutar("SELECT * FROM cargo WHERE cargo_Estatus = true");
$empresa = $a->ejecutar("SELECT * FROM empresa WHERE empresa_Estatus = true");

?>

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
									<h2 class="ml-lg-2 text-light">Personal</h2>
								</div>
								<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
									<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" onclick="crear_personal()">
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
								<!-- <th>ID</th> -->
								<th>Cédula</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Télefono</th>
								<th>Correo</th>
								<th>Dirección</th>
								<th>Empresa</th>
								<th>Cargo</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!-- fIN de la tabla -->
					</div>
				</div>
				<!----Formulario emergente--------->
				<form action="Controlador/Personal.php" method="post">
					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Datos del Personal</h5>
									<div class="negra">
										<div class="hora">
											<h8 aria-label="Close" data-dismiss="modal" id="form_time">00:00:00</h8>
										</div>
										<div class="fecha">
											<h8 class="modal-title" id="form_date">date</h8>
										</div>
									</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Cédula</label>
												<div class="input-group">
													<div class="pretend">
														<select name="Nacionalidad" id="Nacionalidad" class="form-control">
															<option value="V">V</option>
															<option value="E">E</option>
														</select>
													</div>
													<input type="text" pattern="[0-9]{7,8}" maxlength="8" minlength="7" name="Cedula" id="cedula" title="Solo se pueden ingresar caracteres númericos" class="form-control" required>
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Nombre</label>
												<input type="text" maxlength="25" minlength="4" name="Nombre" id="nombre" pattern="[A-Za-z ]+" title="Solo puedes ingresar caracteres alfabeticos" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Apellido</label>
												<input type="text" maxlength="25" minlength="5" name="Apellido" id="apellido" class="form-control" pattern="[A-Za-z ]+" title="Solo puedes ingresar caracteres alfabeticos" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Télefono</label>
												<div class="input-group">
													<div class="pretend">
														<select name="codigo_area" id="codigo_area" class="form-control">
															<option value="0412">0412</option>
															<option value="0416">0416</option>
															<option value="0414">0414</option>
															<option value="0424">0424</option>
														</select>
													</div>
													<input type="tel" pattern="[0-9]{7}" title="Solo se aceptan numeros" maxlength="7" minlength="7" name="Telefono" id="telefono" class="form-control" required>
												</div>


											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Correo</label>
												<input type="email" maxlength="120" minlength="20" name="Correo" id="correo" class="form-control" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Dirección</label>
												<input type="text" name="Direccion" id="direccion" class="form-control" pattern="[A-Za-z0-9 ]+" title="Solo se pueden ingresar caracteres numericos y alfabeticos" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="d-flex flex-column">
												<label for="">Condición del personal</label>
												<div class="d-flex flex-row justify-content-around">
													<div class="form-check ml-2 mr-2">
														<input type="radio" name="condicion" value="E" id="condition" class="form-check-input" required>
														<small class="form-check-label">Externo</small>
													</div>
													<div class="form-check">
														<input type="radio" name="condicion" value="I" id="condition" class="form-check-input" required>
														<small class="form-check-label">Interno</small>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Empresa</label>
												<input type="text" id="empresa2" name="Empresa" class="form-control" style="display: none;" disabled>
												<select name="Empresa" id="sel_empresa" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $empresa->fetch_assoc()) { ?>
														<option name="Empresa" id="empresa" value="<?php echo $a["ID"] ?>"><?php echo $a["empresa_Nombre"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Cargo</label>
												<select name="Cargo" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $cargo->fetch_assoc()) { ?>
														<option name="Cargo" id="cargo" value="<?php echo $a["ID"] ?>"><?php echo $a["cargo_Nombre"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="operacion" id="operacion" value="Registro">
									<input type="hidden" name="ID" id="id" class="id">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="Registro" class="btn btn-success">Enviar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!----Eliminar Datos--------->
				<form action="Controlador/Personal.php" method="POST">
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
			document.querySelectorAll("#condition").forEach(item => {
				item.addEventListener("change", (e) => manipulateDOM(e.target.value))
			})

			const manipulateDOM = (value) => {
				if (value == "I") {
					$("#empresa2").show(150);
					$("#empresa2").val("Procemi");
					$("#sel_empresa").hide(150);
					$("#sel_empresa").attr("disabled", true);
				} else {
					$("#empresa2").hide(150);
					$("#sel_empresa").show(150);
					$("#sel_empresa").removeAttr("disabled");
				}
			}
			$(document).ready(() => {
				/* Creamos el datatable y por medio de la propiedad ajax, le damos la url a consultar y asignamos la propiedad dataSrc, le damos el valor data (ya que es lo que mando desde el controlador)
				 asigno las columnas donde van, y agrego los botones con su evento onclick para las operaciones
				 */
				$("#tabla").DataTable({
					"ajax": {
						"url": "Controlador/Personal.php?operacion=ConsultarTodos",
						"dataSrc": "data"
					},
					"columns": [
						// {
						// 	data: "ID"
						// },
						{
							data: "personal_Cedula",
							render(data, type, row) {
								return `${row.personal_Nacionalidad}-${row.personal_Cedula}`;
							}
						},
						{
							data: "personal_Nombre"
						},
						{
							data: "personal_Apellido"
						},
						{
							data: "personal_Telefono"
						},
						{
							data: "personal_Correo"
						},
						{
							data: "personal_Direccion"
						},
						{
							data: "empresa_Nombre",
							render(data) {
								if (data) return data;
								else return "Procemi";
							}
						},
						{
							data: "cargo_Nombre"
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
				await fetch("Controlador/Personal.php?operacion=ConsultarUno&&id=" + id)
					.then(response => response.json())
					.then(({
						data
					}) => {
						document.querySelectorAll("#condition").forEach(item => {
							if (item.value == data.personal_condicion) item.checked = true;
						})
						manipulateDOM(data.personal_condicion);
						$("#id").val(data.ID)
						$("#nombre").val(data.personal_Nombre)
						$("#apellido").val(data.personal_Apellido)
						$("#Nacionalidad").val(data.personal_Nacionalidad)
						$("#cedula").val(data.personal_Cedula)
						let [codigo, dato2] = data.personal_Telefono.split("-")
						$("#codigo_area").val(codigo)
						$("#telefono").val(dato2)
						$("#correo").val(data.personal_Correo)
						$("#direccion").val(data.personal_Direccion)
						$("#cargo").val(data.ID_Cargo)
					}).catch(error => console.error(error))
			}
			/* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
			const crear_personal = () => $("#operacion").val("Registro")
			const Eliminar = (id) => $(".ID").val(id)
			/* El codigo de aqui abajo lo comente porque no le vi la utilidad, osea, lo comente y no vi cambios */
		</script>
</body>

</html>