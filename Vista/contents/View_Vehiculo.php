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
									<h2 class="ml-lg-2 text-light">Vehiculo Registrados</h2>
								</div>
								<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
									<a href="#addEmployeeModal" class="btn btn-success" onclick="ResetarForm()" data-toggle="modal">
										<i class="material-icons">&#xE147;</i>
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
								<th>Segunda Placa</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>Color</th>
								<th>Empresa</th>
								<th>A??o</th>
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
								<h5 class="modal-title">datos del vehiculo</h5>
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
							<form action="Controlador/Vehiculo.php" method="post" id="formRegistro">
								<div class="modal-body">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Placa del vehiculo</label>
												<input type="text" name="Placa" id="placa" pattern="[A-Z]{3}\d{3}" maxlength="7" minlength="7" class="form-control" onkeyup="Mayuscula(this)" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Modelo del vehiculo</label>
												<select name="Modelo" id="modelo" class="form-control" required>
													<option value="">Seleccione una opci??n</option>
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
												<label for="">Condici??n del vehiculo</label>
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
												<label>documento de identidad del Due??o</label>
												<div class="input-group">
													<div class="pretend">
														<select name="tipoRif" id="tipo_rif" class="form-control" disabled="disabled" required>
															<option value="V">V</option>
															<option value="E">E</option>
														</select>
													</div>
													<input type="text" minlength="8" maxlength="10" name="rif_dueno" disabled="disabled" id="rif_dueno" class="form-control" pattern="[0-9]+" title="Solo puedes ingresar caracteres n??mericos" required>
												</div>
											</div>
											<div class="form-group" id="divEmpresa">
												<label>nombre de la Empresa</label>
												<select name="Empresa" id="empresa" class="form-control" required>
													<option value="">Seleccione una opci??n</option>
													<?php while ($a = $empresa->fetch_assoc()) { ?>
														<option value="<?php echo $a["ID"] ?>"><?php echo $a["empresa_Nombre"] ?></option>
													<?php } ?>

												</select>
												<input type="text" id="empresa2" name="Empresa" class="form-control" disabled>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Color del vehiculo</label>
												<select name="Color" id="color" class="form-control" required>
													<option value="">Seleccione una opci??n</option>
													<?php while ($a = $color->fetch_assoc()) { ?>
														<option name="Color" id="color" value="<?php echo $a["ID"] ?>"><?php echo $a["color_Nombre"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>

									<div class="row" style="display: none;" id="div_dueno1">
										<div class="col-6">
											<div class="form-group">
												<label for="">Nombre del due??o</label>
												<input type="text" name="nombre_dueno" id="nombre_dueno" class="form-control" disabled="disabled">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Correo del due??o</label>
												<input type="email" name="correo_dueno" id="correo_dueno" class="form-control" disabled="disabled">
											</div>
										</div>
									</div>
									<div class="row" style="display: none;" id="div_dueno2">
										<div class="col-6">
											<div class="form-group">
												<label for="">Telefono del due??o</label>
												<input type="text" name="telefono_dueno" id="tele_dueno" class="form-control" disabled="disabled">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label for="">Direcci??n del due??o</label>
												<input type="text" name="dire_dueno" id="dire_dueno" class="form-control" disabled="disabled">
											</div>
										</div>
									</div>

									<div class="row">
										<!-- <div class="col-6">
											<div class="form-group">
												<label>Capacidad del vehiculo</label>
												<div class="input-group">
													<input type="hidden" name="ID" id="id">
													<input type="text" pattern="[0-9]{1,5}(\,[0-9]{2})" step="0.01" max="99999.99" min="10.00" name="Peso" id="peso" class="form-control" required>
													<div class="input-group-append">
														<span class="input-group-text">KG</span>
													</div>
												</div>
											</div>
										</div> -->
										<div class="col-6">
											<input type="hidden" name="ID" id="id">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" value="1" id="if_doble">
												<label class="form-check-label">Tiene una doble carga?</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>A??o del vehiculo</label>
												<input type="text" step="1" pattern="[0-9]+" max="2022" minlength="4" maxlength="4" name="Ano" id="ano" class="form-control" title="Solo puedes ingresar caracteres n??mericos" required>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Placa Extra del vehiculo</label>
												<input type="text" name="segunda_Placa" id="segunda_Placa" disabled="disabled" maxlength="7" minlength="7" pattern="[A-Z]{3}\d{3}" class="form-control" onkeyup="Mayuscula(this)" required>
											</div>
										</div>
									</div>
									<div class="row">
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
									<p>??Est?? seguro de que desea eliminar este registro?</p>
									<p class="text-warning"><small>Esta acci??n no se puede deshacer</small></p>
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
			$("#placa").on("input", function() {
				this.value = this.value.replace(/[^0-9-a-z-A-Z\u00f1\u00d1]/g, '');
			})
			$("#rif_dueno").on("input", function() {
				this.value = this.value.replace(/[^0-9]/g, '');
			})
			$("#segunda_Placa").on("input", function() {
				this.value = this.value.replace(/[^0-9-a-z-A-Z\u00f1\u00d1]/g, '');
			})
			$("#peso_extra").on("input", function() {
				this.value = this.value.replace(/[^0-9]/g, '');
			})
			$("#peso").on("input", function() {
				this.value = this.value.replace(/[^0-9]/g, '');
			})

			document.getElementById("rif_dueno").addEventListener("keyup", async (e) => {
				if (e.target.value.length > 7) {
					$("#tipo_rif option[value='E']").attr("selected", true);
				} else {
					$("#tipo_rif option[value='E']").attr("selected", false);
				}
			})

			document.getElementById("ano").addEventListener("keyup", async (e) => {
				if (e.target.value.length == 4) {
					if (e.target.value >= 2023 || e.target.value <= 1950) {
						alert("A??o invalido");
						$("#ano").val("");
					}
				}

			})


			document.getElementById("placa").addEventListener("keyup", async (e) => {
				if (e.target.value.length >= 4) {
					await fetch(`Controlador/Vehiculo.php?operacion=ConsultarPlaca&&placa=${e.target.value}`)
						.then(response => response.json())
						.then(result => {
							if (result.data) {
								alert("Placa ya registrado")
								$("#placa").val("");
							}
						}).catch(error => console.error(error))
				}
			})

			document.getElementById("rif_dueno").addEventListener("keyup", async (e) => {
				if (e.target.value.length >= 4) {
					await fetch(`Controlador/Vehiculo.php?operacion=ConsultarCedula&&cedula=${e.target.value}`)
						.then(response => response.json())
						.then(result => {
							if (result.data) {
								alert(result.data)
								$("#rif_dueno").val("");
							}
						}).catch(error => console.error(error))
				}
			})

			document.getElementById("formRegistro").addEventListener("submit", (e) => {
				e.preventDefault();
				if ($("#if_doble")[0].checked) {
					if ($("#placa").val() == $("#segunda_Placa").val()) {
						alert("La placa principal del vehiculo y la secundaria no pueden ser iguales")
						$("#segunda_Placa").val('');
						return false;

					} else {
						$("#formRegistro").submit();
					}
				} else {
					$("#formRegistro").submit();
				}
			})
			$("#segunda_Placa").keyup(e => {
				if (e.target.value != "") {
					if ($("#placa").val() == e.target.value) {
						alert("La placa principal del vehiculo y la secundaria no pueden ser iguales")
						$("#segunda_Placa").val('');
					}
				}
			})

			document.getElementById("if_doble").addEventListener("click", (e) => manipulatePlaca(e.target.checked))

			const manipulatePlaca = (value) => {
				if (!value || value == 0) {
					$("#peso_extra").attr("disabled", true);
					$("#segunda_Placa").attr("disabled", true);
				} else {
					$("#peso_extra").removeAttr("disabled");
					$("#segunda_Placa").removeAttr("disabled");
				}
			}
			const manipulateDOM = (value) => {
				if (value == "I") {
					$("#empresa2").show(150);
					$("#empresa2").val("Procemi");
					$("#empresa").hide(150);
				}
				if (value != "E") {
					$("#empresa").attr("disabled", true);

					if (value == "P") {
						$("#divEmpresa").hide(150, () => {
							$("#divRifDueno").show(150)
							$("#rif_dueno").removeAttr("disabled");
							$("#tipo_rif").removeAttr("disabled");
						});
						$("#div_dueno1").show(150, () => {
							$("#nombre_dueno").removeAttr("disabled");
							$("#correo_dueno").removeAttr("disabled");
						});
						$("#div_dueno2").show(150, () => {
							$("#tele_dueno").removeAttr("disabled");
							$("#dire_dueno").removeAttr("disabled");
						});
					} else {
						$("#divRifDueno").hide(150, () => {
							$("#divEmpresa").show(150)
							$("#rif_dueno").attr("disabled", true);
							$("#tipo_rif").attr("disabled", true);
						});
						$("#div_dueno1").hide(150, () => {
							$("#nombre_dueno").attr("disabled", true);
							$("#correo_dueno").attr("disabled", true);
						});
						$("#div_dueno2").hide(150, () => {
							$("#tele_dueno").attr("disabled", true);
							$("#dire_dueno").attr("disabled", true);
						});
					}
				} else {
					$("#divRifDueno").hide(150, () => {
						$("#divEmpresa").show(150)
						$("#empresa").show(150);
						$("#empresa2").hide(150);
						$("#rif_dueno").attr("disabled", true);
						$("#tipo_rif").attr("disabled", true);
						$("#empresa").removeAttr("disabled");
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
							data: "segunda_Placa",
							render(data) {
								if (data == null) return "No tiene";
								else return data;
							}
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
							data: "empresa_Nombre",
							render(data, type, row) {
								if (row.condicion == "I") return "PROCEMI";
								if (row.condicion == "P") return "PARTICULAR";
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
						manipulatePlaca(data.if_doble);
						console.log(data);
						$("#id").val(data.ID)
						$("#placa").val(data.vehiculo_Placa)
						$("#empresa").val(data.ID_Empresa)
						$("#modelo").val(data.ID_Modelo)
						$("#color").val(data.ID_Color)
						$("#peso").val(data.vehiculo_Peso)
						$("#ano").val(data.vehiculo_Ano)
						$("#peso_extra").val(data.Vehiculo_PesoSecundario)
						$("#segunda_Placa").val(data.segunda_Placa);
						$("#if_doble").attr("checked", data.if_doble)
						let [tipo, cedula] = data.rif_dueno.split("-")
						$("#tipo_rif").val(tipo);
						$("#rif_dueno").val(cedula);
					}).catch(error => console.error(error))
			}
			/* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
			const crear_vehiculo = () => {
				$("#operacion").val("Registro")
				$("#placa").val("")
				$("#divEmpresa").hide(150, () => {
					$("#divRifDueno").show(150)
					$("#rif_dueno").removeAttr("disabled");
					$("#tipo_rif").removeAttr("disabled");
				});
				$("#modelo").val("")
				$("#color").val("")
				$("#peso").val("")
				$("#ano").val("")
				$("#peso_extra").val("")
				$("#segunda_Placa").val("");
				$("#if_doble").checked = false;
				$("#tipo_rif").val("");
				$("#rif_dueno").val("");
			}
			const Eliminar = (id) => $(".ID").val(id)
			/* El codigo de aqui abajo lo comente porque no le vi la utilidad, osea, lo comente y no vi cambios */
		</script>
</body>

</html>