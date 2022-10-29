<?php
include("Modelo/Conexion.php");
$a = new bd();
$Estatus = true;
$modelo = $a->ejecutar("SELECT modelo.*,marca.marca_Nombre FROM modelo INNER JOIN marca ON marca.ID = modelo.ID_Marca WHERE modelo_Estatus = $Estatus");
$color = $a->ejecutar("SELECT * FROM color WHERE color_Estatus = $Estatus");
$empresa = $a->ejecutar("SELECT * FROM empresa WHERE empresa_Estatus = $Estatus");
$vehiculos = $a->ejecutar("SELECT * FROM vehiculo WHERE vehiculo_Estatus = $Estatus");

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
									<h2 class="ml-lg-2">Vehiculo</h2>
								</div>
								<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
									<a href="#addEmployeeModal" class="btn btn-success" onclick="ResetarForm()" data-toggle="modal">
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
								<th>Marca</th>
								<th>Modelo</th>
								<th>Color</th>
								<th>Peso</th>
								<th>Empresa</th>
								<th>Año</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!-- fIN de la tabla -->
					</div>
				</div>
				<!----Formulario emergente--------->

				<div class="modal row fade" tabindex="-1" id="addEmployeeModal" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">vehiculo</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="Controlador/Vehiculo.php" method="post" id="formRegistro">
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Placa</label>
												<input type="text" name="Placa" id="placa" maxlength="7" minlength="7" pattern="[A-Z0-9]{7}" class="form-control" onkeyup="Mayuscula(this)" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Modelo</label>
												<select name="Modelo" id="modelo" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $modelo->fetch_assoc()) { ?>
														<option value="<?php echo $a["ID"]; ?>"><?php echo $a["modelo_Nombre"] . " " . $a['marca_Nombre']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="d-flex flex-column">
												<label for="">Condición del vehiculo</label>
												<div class="d-flex flex-row justify-content-around">
													<div class="form-check">
														<input type="radio" name="condicion" value="P" id="condition" class="form-check-input" required>
														<small class="form-check-label">Particular</small>
													</div>
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
											<div class="form-group" style="display: none;" id="divRifDueno">
												<label>Rif de Dueño</label>
												<div class="input-group">
													<div class="pretend">
														<select name="tipoRif" id="tipo_rif" class="form-control" disabled="disabled" required>
															<option value="V">V</option>
															<option value="J">J</option>
														</select>
													</div>
													<input type="text" minlength="10" maxlength="10" name="rif_dueno" disabled="disabled" id="rif_dueno" class="form-control" required placeholder="Rif">
												</div>

											</div>
											<div class="form-group" id="divEmpresa">
												<label>Empresa</label>
												<select name="Empresa" id="empresa" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $empresa->fetch_assoc()) { ?>
														<option value="<?php echo $a["ID"] ?>"><?php echo $a["empresa_Nombre"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Color</label>
												<select name="Color" id="color" class="form-control" required>
													<option value="">Seleccione una opción</option>
													<?php while ($a = $color->fetch_assoc()) { ?>
														<option name="Color" id="color" value="<?php echo $a["ID"] ?>"><?php echo $a["color_Nombre"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Peso</label>
												<input type="hidden" name="ID" id="id">
												<input type="number" pattern="[0-9]{1,5}(\,[0-9]{2})" step="0.01" max="99999.99" min="10.00" name="Peso" id="peso" class="form-control" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" value="1" id="if_doble">
												<label class="form-check-label">Tiene una doble carga?</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Año</label>
												<input type="number" step="1" pattern="[0-9]{4}" minlength="4" maxlength="4" name="Ano" id="ano" class="form-control" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Peso Extra</label>
												<input type="number" pattern="[0-9]{1,5}(\,[0-9]{2})" step="0.01" max="99999.99" min="10.00" disabled="disabled" id="peso_extra" name="Vehiculo_PesoSecundario" id="pesoextra" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Placa</label>
												<input type="text" name="segunda_Placa" id="segunda_Placa" disabled="disabled" maxlength="7" minlength="7" pattern="[A-Z0-9]{7}" class="form-control" onkeyup="Mayuscula(this)" required>
											</div>
										</div>
									</div>

								</div>
								<div class="modal-footer">
									<input type="hidden" name="operacion" id="operacion" value="Registro">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="Registro" class="btn btn-success">Enviar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!----Eliminar Datos--------->
				<form action="Controlador/Vehiculo.php" method="post">
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
			document.getElementById("if_doble").addEventListener("click", (e) => {
				if (!e.target.checked) {
					$("#peso_extra").attr("disabled", true);
					$("#segunda_Placa").attr("disabled", true);
				} else {
					$("#peso_extra").removeAttr("disabled");
					$("#segunda_Placa").removeAttr("disabled");
				}
			})
			const manipulateDOM = (value) => {
				if (value != "E") {
					$("#empresa").attr("disabled", true);

					if (value == "P") {
						$("#divEmpresa").hide(150, () => {
							$("#divRifDueno").show(150)
							$("#rif_dueno").removeAttr("disabled");
							$("#tipo_rif").removeAttr("disabled");
						});
					} else {
						$("#divRifDueno").hide(150, () => {
							$("#divEmpresa").show(150)
							$("#rif_dueno").attr("disabled", true);
							$("#tipo_rif").attr("disabled", true);
						});
					}
				} else {
					$("#empresa").removeAttr("disabled");
					$("#divRifDueno").hide(150, () => {
						$("#divEmpresa").show(150)
						$("#rif_dueno").attr("disabled", true);
						$("#tipo_rif").attr("disabled", true);
					});
				}
			}
			document.querySelectorAll("#condition").forEach(item => {
				item.addEventListener("change", (e) => manipulateDOM(e.target.value))
			})

			const ResetarForm = () => document.getElementById("formRegistro").reset();

			const Mayuscula = (e) => e.value = e.value.toUpperCase();
			let year = new Date().getFullYear();

			document.getElementById("ano").max = year;

			$(document).ready(() => {
				/* Creamos el datatable y por medio de la propiedad ajax, le damos la url a consultar y asignamos la propiedad dataSrc, le damos el valor data (ya que es lo que mando desde el controlador)
				 asigno las columnas donde van, y agrego los botones con su evento onclick para las operaciones
				 */
				$("#tabla").DataTable({
					"ajax": {
						"url": "Controlador/Vehiculo.php?operacion=ConsultarTodos",
						"dataSrc": "data"
					},
					"columns": [{
							data: "ID"
						},
						{
							data: "vehiculo_Placa"
						},
						{
							data: "marca_Nombre"
						},
						{
							data: "modelo_Nombre"
						},
						{
							data: "color_Nombre"
						},
						{
							data: "vehiculo_Peso",
							render(data){
								return data+" KG.";
							}
						},
						{
							data: "empresa_Nombre",
							render(data, type, row) {
								if (row.condicion == "I") return "Interno";
								if (row.condicion == "P") return "Particular";
								if (row.condicion == "E") return data;
							}
						},
						{
							data: "vehiculo_Ano"
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
				await fetch("Controlador/Vehiculo.php?operacion=ConsultarUno&&id=" + id)
					.then(response => response.json())
					.then(({
						data
					}) => {
						document.querySelectorAll("#condition").forEach(item => {
							if (item.value == data.condicion) item.checked = true;
						})
						manipulateDOM(data.condicion);

						$("#id").val(data.ID)
						$("#placa").val(data.vehiculo_Placa)
						$("#empresa").val(data.ID_Empresa)
						$("#modelo").val(data.ID_Modelo)
						$("#color").val(data.ID_Color)
						$("#peso").val(data.vehiculo_Peso)
						$("#ano").val(data.vehiculo_Ano)
						let [tipo, cedula] = data.rif_dueno.split("-")

						$("#tipo_rif").val(tipo);
						$("#rif_dueno").val(cedula);
					}).catch(error => console.error(error))
			}
			/* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
			const crear_vehiculo = () => $("#operacion").val("Registro")
			const Eliminar = (id) => $(".ID").val(id)
			/* El codigo de aqui abajo lo comente porque no le vi la utilidad, osea, lo comente y no vi cambios */
		</script>
</body>

</html>