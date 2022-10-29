<?php
include("Modelo/Conexion.php");
$a = new bd();
$vehiculo = $a->ejecutar("SELECT * FROM vehiculo WHERE vehiculo_Estatus = true");
$empresa = $a->ejecutar("SELECT * FROM empresa WHERE empresa_Estatus = true");
$producto = $a->ejecutar("SELECT * FROM producto WHERE producto_Estatus = true");
$vehiculos = $a->ejecutar("SELECT * FROM vehiculo WHERE vehiculo_Estatus = true");
$personal = $a->ejecutar("SELECT * FROM personal WHERE personal_Estatus = true");

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
									<h2 class="ml-lg-2">Entrada</h2>
								</div>
								<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
									<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" onclick="crear_entrada()">
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
								<th>Placa</th>
								<th>Cédula</th>
								<th>Empresa</th>
								<th>Condición de la empresa</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Estado</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!-- fIN de la tabla -->
					</div>
				</div>
				<!----Formulario emergente--------->
				<form action="Controlador/Entrada.php" method="post">
					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Personal</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Producto</label>
												<select name="id_producto" id="producto" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $producto->fetch_assoc()) { ?>
														<option value="<?php echo $a["ID"] ?>"><?php echo $a["producto_Nombre"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Empresa</label>
												<select name="id_empresa" id="empresa" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $empresa->fetch_assoc()) { ?>
														<option value="<?php echo $a["ID"] ?>"><?php echo $a["empresa_Nombre"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Personal</label>
												<select name="id_personal" id="cedula" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $personal->fetch_assoc()) { ?>
														<option value="<?php echo $a["ID"]; ?>"><?php echo $a["personal_Nacionalidad"] . "-" . $a["personal_Cedula"] . " " . $a['personal_Nombre']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Vehiculo</label>
												<select name="id_vehiculo" id="Placa" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $vehiculos->fetch_assoc()) {
													?>
														<option value="<?php echo $a["ID"]; ?>"><?php echo $a["vehiculo_Placa"]; ?></option>
													<?php }
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="d-flex flex-column">
												<label for="">Condición de la empresa</label>
												<div class="d-flex flex-row justify-content-around">
													<div class="form-check ml-2 mr-2">
														<input type="radio" name="condicion_empresa" value="E" id="condition" class="form-check-input" required>
														<small class="form-check-label">Externo</small>
													</div>
													<div class="form-check">
														<input type="radio" name="condicion_empresa" value="I" id="condition" class="form-check-input" required>
														<small class="form-check-label">Interno</small>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label>Cantidad</label>
												<input type="number" step="1" min="1" name="cantidad" id="cantidad" class="form-control" required>
											</div>
										</div>
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
				<!----Eliminar Datos--------->
				<form action="Controlador/Entrada.php" method="post">
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
						"url": "Controlador/Entrada.php?operacion=ConsultarTodos",
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
							data:"condicion_empresa",
							render(data){
								if(data == "E") return "Externa";
								else return "Interna";
							}
						},
						{
							data: "producto_Nombre"
						},
						{
							data: "m_Cantidad"
						},
						{
							data: "status_proceso",
							render(data) {
								if (data == 'R') return "En Revisión";
								if (data == 'D') return "Devuelto";
								if (data == 'A') return "Aprobado";
								if (data == 'S') return "En el Silo";
							}
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

								if (row.status_proceso == "D") return btn;
								return null;
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
				await fetch("Controlador/Entrada.php?operacion=ConsultarUno&&id=" + id)
					.then(response => response.json())
					.then(({
						data
					}) => {
						$("#id").val(data.ID)
						$("#Placa").val(data.ID_Vehiculo)
						$("#cedula").val(data.ID_Personal)
						$("#empresa").val(data.ID_Empresa)
						$("#producto").val(data.ID_Producto)
						$("#cantidad").val(data.m_Cantidad)
					}).catch(error => console.error(error))
			}
			/* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
			const crear_entrada = () => $("#operacion").val("Registro")
			const Eliminar = (id) => $(".ID").val(id)
			const ConsultVehiculos = async (idEmpresa) => {
				if (!idEmpresa) return false;
				await fetch(`Controlador/Vehiculo.php?operacion=ConsultPorEmpresa&&id=${idEmpresa}`)
					.then(response => response.json())
					.then(({
						data
					}) => {
						data.forEach(item => {
							console.log(item);
							$("#Placa").prepend(`<option value='${item.ID}'>${item.vehiculo_Placa} </option>`);
						})

					}).catch(error => console.error(error))
			}


			// document.getElementById("cedula").addEventListener("keyup", async (e) => {
			// 	// Aqui puedes agregar una validación para que esta función no se ejecute demasiado, ejemplo, 
			// 	// si el minimo que podras para las cedulas es de 7, puedes agregar la condición de que esta consulta solo 
			// 	// se ejecute si la cedula ingresada es mayor o igual a 7 caracteres
			// 	if (e.target.value.length >= 7) {
			// 		const resultado = await fetch("Controlador/Personal.php?operacion=ConsultarCedula&&cedula=" + e.target.value)
			// 			.then(response => response.json()).then(result => result).catch(error => console.error(error))
			// 		if (resultado.data) {
			// 			Swal.fire({
			// 				position: 'top-end',
			// 				icon: 'success',
			// 				title: `Persona Registrada Es ${resultado.data.personal_Nombre} ${resultado.data.personal_Apellido}`,
			// 				showConfirmButton: false,
			// 				timer: 5000
			// 			})
			// 		}
			// 	}
			// })

			// document.getElementById("placa").addEventListener("keyup", async (e) => {
			// 	// Aqui puedes agregar una validación para que esta función no se ejecute demasiado, ejemplo, 
			// 	// si el minimo que podras para las cedulas es de 7, puedes agregar la condición de que esta consulta solo 
			// 	// se ejecute si la cedula ingresada es mayor o igual a 7 caracteres
			// 	if (e.target.value.length >= 1) {
			// 		const resultado = await fetch("Controlador/Vehiculo.php?operacion=ConsultarPlaca&&placa=" + e.target.value)
			// 			.then(response => response.json()).then(result => result).catch(error => console.error(error))
			// 		if (resultado.data) {
			// 			Swal.fire({
			// 				position: 'top-end',
			// 				icon: 'success',
			// 				title: `Registrado`,
			// 				showConfirmButton: false,
			// 				timer: 5000
			// 			})
			// 		}
			// 	}
			// })
		</script>
</body>

</html>