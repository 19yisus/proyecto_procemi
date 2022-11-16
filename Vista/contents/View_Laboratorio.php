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
									<h2 class="ml-lg-2 text-light">Laboratorio</h2>
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
								<th>Muestra</th>
								<th>granos Dañados</th>
								<th>granos partidos</th>
								<th>Humedad</th>
								<th>Impureza</th>
								<th>Estatus</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!-- fIN de la tabla -->
					</div>
				</div>
				<div class="modal fade" tabindex="-1" id="modalConsult" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Consulta</h5>

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="modalConsulta">

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
				<!----Formulario emergente--------->
				<form action="Controlador/Laboratorio.php" method="POST" id="formulario" autocomplete="off">
					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Laboratorio</h5>
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
									<div class="row" style="text-align: center">
										<div class="col-3">
											<div class="form-group">
												<label>Nombre del producto</label>
												<input type="text" id="des_product" class="form-control" disabled style="background : white; border: none; text-align: center">
											</div>
										</div>
										<div class="col-3">
											<div class="form-group">
												<label>Cédula del chofer</label>
												<input type="text" id="ced_chofer" class="form-control" disabled style="background : white; border: none; text-align: center">
											</div>
										</div>
										<div class="col-3">
											<div class="form-group">
												<label>Placa del vehiculo</label>
												<input type="text" id="placa_vehi" class="form-control" disabled style="background : white; border: none; text-align: center">
											</div>
										</div>
										<div class="col-3">
											<div class="form-group">
												<label>Nombre de la empresa</label>
												<input type="text" id="empresa_nombre" class="form-control" disabled style="background : white; border: none; text-align: center">
											</div>
										</div>
									</div>
									<input type="hidden" name="Cantidad" id="cantidad">
									<div class="row">
										<div class="col-12">
											<div class="form-group" id="div_muestra">
												<label>Muestra</label>
												<div class="input-group">
													<input type="number" step="1" pattern="[0-9]{1,11}" min="Solo se aceptan numeros" minlength="1" maxlength="3" name="Muestra" id="muestra" class="form-control" required>
													<div class="input-group-append">
														<span class="input-group-text">%</span>
													</div>
												</div>
											</div>
											<div class="form-group" id="div_obser" style="display: none;">
												<label>Observación</label>
												<input type="text" minlength="1" maxlength="60" name="observacion" id="observacion" class="form-control" required disabled="disabled">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<div class="d-flex flex-column">
												<label for="">Estatus de la operación</label>
												<div class="d-flex flex-row justify-content-around">
													<div class="form-check">
														<input type="radio" name="estatus_ope" value="A" id="estatus_ope" class="form-check-input" required disabled="disabled">
														<small class="form-check-label">Aprobada</small>
													</div>
													<div class="form-check ml-2 mr-2">
														<input type="radio" name="estatus_ope" value="D" id="estatus_ope" class="form-check-input" required disabled="disabled">
														<small class="form-check-label">Rechazada</small>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Grano Dañado</label>
												<div class="input-group">
													<input type="number" step="00.1" min="00.1" min="0.01" max="100" minlength="1" maxlength="3" name="Dano" id="dano" class="form-control porcentaje" required disabled="disabled">
													<div class="input-group-append">
														<span class="input-group-text">%</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label>Grano Partido</label>
												<div class="input-group">
													<input type="number" step="00.1" min="00.1" min="0.01" max="100" minlength="1" maxlength="3" name="Partido" id="partido" class="form-control" required disabled="disabled">
													<div class="input-group-append">
														<span class="input-group-text">%</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label>Humedad</label>
												<div class="input-group">
													<input type="number" step="00.1" min="00.1" min="Solo se aceptan numeros" maxlength="4" name="Humedad" id="humedad" class="form-control" required disabled="disabled">
													<div class="input-group-append">
														<span class="input-group-text">%</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<input type="hidden" name="ID" id="id">
												<label>Impureza</label>
												<div class="input-group">
													<input type="number" step="00.1" min="Solo se aceptan numeros" min="00.1" maxlength="4" name="Impureza" id="impureza" class="form-control" required disabled="disabled">
													<div class="input-group-append">
														<span class="input-group-text">%</span>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="modal-footer">
									<input type="hidden" name="operacion" id="operacion" value="Registro">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="Registro" class="btn btn-success">Enviar</button>
									<!-- <button type="button" onclick="rechazo()" name="Rechazo" class="btn btn-danger">Rechazar</button> -->
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
					const consultarModal = async (value) => {
						await fetch("Controlador/Entrada.php?operacion=ConsultarModal&&id=" + value)
							.then(response => response.text())
							.then(result => {
								console.log(value)
								$("#modalConsulta").html(result)
							}).catch(error => console.error(error))
					}
					const manipulateDOM = (value) => {
						if (value == "D") {
							$("#operacion").val("Rechazo");
							$("#muestra").attr("disabled", true);
							$("#div_muestra").hide(150, () => {
								$("#div_obser").show(150)
								$("#observacion").removeAttr("disabled");

								// $("#muestra").attr("disabled", true);
								// $("#peso").attr("disabled", true);
								// $("#humedad").attr("disabled", true);
								// $("#impureza").attr("disabled", true);
								// $("#dano").attr("disabled", true);
								// $("#partido").attr("disabled", true);
							});
						} else {
							$("#operacion").val("Registro");
							$("#observacion").attr("disabled", true);
							$("#div_obser").hide(150, () => {
								$("#div_muestra").show(150)
								// $("#muestra").removeAttr("disabled");
								// $("#peso").removeAttr("disabled");
								// $("#humedad").removeAttr("disabled");
								// $("#impureza").removeAttr("disabled");
								// $("#dano").removeAttr("disabled");
								// $("#partido").removeAttr("disabled");
							});
						}
					}
					document.querySelectorAll("#estatus_ope").forEach(item => {
						item.addEventListener("change", (e) => manipulateDOM(e.target.value))
					})
					$(document).ready(() => {
						/* Creamos el datatable y por medio de la propiedad ajax, le damos la url a consultar y asignamos la propiedad dataSrc, le damos el valor data (ya que es lo que mando desde el controlador)
						 asigno las columnas donde van, y agrego los botones con su evento onclick para las operaciones
						 */
						$("#tabla").DataTable({
							"ajax": {
								"url": "Controlador/Laboratorio.php?operacion=ConsultarTodos",
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
									data: "empresa_Nombre",
									render(data, type, row) {
										if (row.condicion_empresa == "E") return data;
										else return "Procemi";
									}
								},
								{
									data: "producto_Nombre"
								},
								{
									data: "m_Cantidad",
									render(data) {
										return data + "KG";
									}
								},
								{
									data: "m_Muestra",
									render(data) {
										if (data == null) return "Sin muestra";
										else return data + "%";
									}
								},
								{
									data: "m_Dano",
									render(data) {
										if (data == null) return "Sin analizar";
										else return data + "%";
									}
								},
								{
									data: "m_Partido",
									render(data) {
										if (data == null) return "Sin analizar";
										else return data + "%";
									}
								},
								{
									data: "m_Humedad",
									render(data) {
										if (data == null) return "Sin analizar";
										else return data + "%";
									}
								},
								{
									data: "m_Impureza",
									render(data) {
										if (data == null) return "Sin analizar";
										else return data + "%";
									}
								},
								{
									data: "status_proceso",
									render(data) {
										if (data == 'R') return "En Revisión";
										if (data == 'P') return "Por analizar";
										if (data == 'D') return "Devuelto por laboratorio";
										if (data == 'A') return "Aprobado por laboratorio";
										if (data == 'S') return "En el Silo";
									}
								},
								{
									defaultContent: "",
									render(data, type, row) {
										let btn = `
									<a href="#addEmployeeModal" class="Delete" id="delete" data-toggle="modal" onclick="consultarUno('${row.ID}')">
									<i class="material-icons">&#xE147;</i>
									</a> 
									<a href="#modalConsult" class="edit" data-toggle="modal" onclick="consultarModal('${row.ID}')">
									<i class="material-icons">apps</i>
									</a>`
										return btn;
									}
								}
							],
							language: {
								url: `Vista/js/DataTable.config.json`
							}
						})
					})
					const consultarUno = async (id) => {
						$("#operacion").val("Registro");
						await fetch("Controlador/Laboratorio.php?operacion=ConsultarUno&&id=" + id)
							.then(response => response.json())
							.then(({
								data
							}) => {
								console.log(data);

								$("#id").val(data.ID)
								$("#cantidad").val(data.m_Cantidad)
								$("#muestra").val(data.m_Muestra)
								$("#muestra").attr("max", data.m_Cantidad)

								if (data.m_Muestra != null) {
									console.log(data.m_Impureza)
									if (data.m_Impureza != null) {
										document.querySelectorAll("#estatus_ope").forEach(item => {
											$(item).removeAttr("disabled");
										})
									}

									$("#dano").val(data.m_Dano)
									$("#partido").val(data.m_Partido);
									$("#humedad").val(data.m_Humedad)
									$("#impureza").val(data.m_Impureza)

									$("#dano").removeAttr("disabled")
									$("#partido").removeAttr("disabled");
									$("#humedad").removeAttr("disabled")
									$("#impureza").removeAttr("disabled")
									// $("#estatus_ope").val(data.m_)
								}
								$("#des_product").val(data.producto_Nombre)
								$cedula = data.personal_Nacionalidad + "-" + data.personal_Cedula;
								$("#ced_chofer").val($cedula)
								$("#placa_vehi").val(data.vehiculo_Placa)
								if (data.empresa_Nombre == null) {
									$("#empresa_nombre").val("Procemi");
								} else {
									$("#empresa_nombre").val(data.empresa_Nombre);
								}
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
					const rechazo = () => {
						$("#cantidad").removeAttr("required");
						$("#muestra").removeAttr("required");
						$("#dano").removeAttr("required");
						$("#humedad").removeAttr("required");
						$("#impureza").removeAttr("required");
						$("#operacion").val("rechazo");
						$("#formulario").submit();
					}
				</script>
</body>

</html>