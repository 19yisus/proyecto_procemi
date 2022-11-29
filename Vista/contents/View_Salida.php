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
									<h2 class="ml-lg-2 text-light">Salida</h2>
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
								<th>Peso Bruto</th>
								<th>Peso Tara</th>
								<!-- <th>Cantidad Producto</th> -->
								<th>Silo</th>
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
				<form action="Controlador/Salida.php" method="POST">
					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Salida del producto</h5>
									<div class="negra">
										<div class="hora">
										<h8 aria-label="Close" data-dismiss="modal"id="form_time">00:00:00</h8>
										</div>
										<div class="fecha">
										<h8 class="modal-title"id="form_date">date</h8>
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
									<div class="row" style="text-align: center">
										<div class="col-4">
											<div class="form-group">
												<label>Peso Tara</label>
												<input type="number" step="1" name="Tara" id="peso" class="form-control" required>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label>Peso Bruto</label>
												<input type="number" step="1" name="peso_bruto" id="peso_bruto" class="form-control" readonly required style="background : white; border: none; text-align: center">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label>Peso Neto</label>
												<input type="number" step="1" name="peso_neto" id="peso_neto" class="form-control" readonly required style="background : white; border: none; text-align: center">
											</div>
										</div>
									</div>
									<div class="form-group">
										<input type="hidden" name="Cantidad" id="cantidad">
										<label>Silos</label>
										<select name="Silo" id="silo" class="form-control" required>
											<option value="1">Silo 1</option>
											<option value="2">Silo 2</option>
											<option value="3">Silo 3</option>
											<option value="4">Silo 4</option>
										</select>
									</div>

								</div>
								<div class="modal-footer">
									<input type="hidden" name="ID" id="id">
									<input type="hidden" name="Humedad" id="Humedad">
									<input type="hidden" name="Impureza" id="Impureza">
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
					const consultarModal = async (value) => {
						await fetch("Controlador/Entrada.php?operacion=ConsultarModal&&id=" + value)
							.then(response => response.text())
							.then(result => {
								console.log(value)
								$("#modalConsulta").html(result)
							}).catch(error => console.error(error))
					}
					$("#peso").keyup(e => {
						let peso_bruto = parseInt($("#peso_bruto").val());
						let valor = parseInt(e.target.value);
						$("#peso_neto").val(peso_bruto - valor)
					});


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
										return data + " KG.";
									}
								},
								{
									data: "m_pesoFinal",
									render(data) {
										if (data == null)return "Sin pesar";
										else return data + " KG.";
									}
								},
								// {
								// 	data: "m_Total"
								// },
								{
									data: "m_Silo"
								},
								{
									defaultContent: "",
									render(data, type, row) {
										let btn = `
										<a href="#addEmployeeModal" class="edit" data-toggle="modal" onclick="consultarUno('${row.ID}')">
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
										</a>
										<a href="#modalConsult" class="edit" data-toggle="modal" onclick="consultarModal('${row.ID}')">
									<i class="material-icons">apps</i>
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
								$("#id").val(data.id_detalle)
								$("#cantidad").val(data.m_Cantidad)
								$("#peso_bruto").val(data.m_Cantidad)
								$("#peso_neto").val(data.m_Cantidad)
								$("#peso").val(data.PesoNeto)
								$("#peso").attr("max", (data.m_Cantidad - 1))
								$("#des_product").val(data.producto_Nombre)
								$codigo = data.personal_Nacionalidad
								$telefono = data.personal_Cedula
								$("#ced_chofer").val($codigo + "-" + $telefono);
								$("#placa_vehi").val(data.vehiculo_Placa)
								if (data.empresa_Nombre == null) {
									$("#empresa_nombre").val("Procemi");
								} else {
									$("#empresa_nombre").val(data.empresa_Nombre);
								}
								
								$("#Humedad").val(data.m_Humedad)
								$("#Impureza").val(data.m_Impureza)
								if (data.m_Silo != "N") $("#silo").val(data.m_Silo)
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