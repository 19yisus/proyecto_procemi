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
									<h2 class="ml-lg-2">Laboratorio</h2>
								</div>
							</div>
						</div>
						<!-- Tabla -->
						<table class="table table-striped table-hover" id="tabla">
							<thead>
								<th>ID</th>
								<th>Placa</th>
								<th>Cédula</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Muestra</th>
								<th>Daño</th>
								<th>Humedad</th>
								<th>Impureza</th>
								<th>Total</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!-- fIN de la tabla -->
					</div>
				</div>
				<!----Formulario emergente--------->
				<form action="Controlador/Laboratorio.php" method="POST" id="formulario">
					<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Laboratorio</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="Cantidad" id="cantidad">
									<div class="form-group">
										<label>Muestra</label>
										<input type="text" pattern="[0-9]{1,11}" min="Solo se aceptan numeros" minlength="1" maxlength="11" name="Muestra" id="muestra" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Grano Dañado</label>
										<input type="text" pattern="[0-9]{1,11}" min="Solo se aceptan numeros" minlength="1" maxlength="11" name="Dano" id="dano" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Grano Partido</label>
										<input type="text" pattern="[0-9]{1,11}" min="Solo se aceptan numeros" minlength="1" maxlength="11" name="Partido" id="partido" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Humedad</label>
										<input type="number" step="00.1" min="00.1" min="Solo se aceptan numeros" maxlength="3" name="Humedad" id="humedad" class="form-control" required>
									</div>
									<div class="form-group">
										<input type="hidden" name="ID" id="id">
										<label>Impureza</label>
										<input type="number" step="00.1" min="Solo se aceptan numeros" min="00.1" maxlength="3" name="Impureza" id="impureza" class="form-control" required>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="operacion" id="operacion" value="Registro">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button type="submit" name="Registro" class="btn btn-success">Enviar</button>
									<button type="button" onclick="rechazo()" name="Rechazo" class="btn btn-danger">Rechazar</button>
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
									data: "producto_Nombre"
								},
								{
									data: "m_Cantidad"
								},
								{
									data: "m_Muestra"
								},
								{
									data: "m_Dano"
								},
								{
									data: "m_Humedad"
								},
								{
									data: "m_Impureza"
								},
								{
									data: "m_PesoLab"
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
								$("#dano").val(data.m_Dano)
								$("#humedad").val(data.m_Humedad)
								$("#impureza").val(data.m_Impureza)
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
					const rechazo = () =>{
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