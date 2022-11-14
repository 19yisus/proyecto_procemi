<!-- Para empezar, optimice las lineas de codigo, y le di identacion al codigo para que se va mas ordenao y legible, como veras varias secciones de la pagina ya no estan.
	A estas secciones las estoy trabajando como componentes reutilizable, para no tener el mismo codigo repetido en todas las paginas -->
<!doctype html>
<html lang="en">
<link rel="stylesheet" href="<?php $this->Assets('css/style.css'); ?>">
<!-- custom js file link  -->
<script src="<?php $this->Assets('js/script.js'); ?>" defer></script>
<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?php $this->Component("header"); ?>

<body>
	<?php $this->Component("menu"); ?>
	<!------------>
	<!-----Contenido----------->
	<div id="content">
		<!------PANEL SUPERIOR----------->
		<?php $this->Component("navbar"); ?>

		<!-- Maria -->
		<div class="main-content">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrapper">
						<div class="table-title">
							<div class="row">
								<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
									<h2 class="ml-lg-2 text-light">PROCEMI</h2>
								</div>
							</div>
						</div>
						<br>
						<?php if ($_SESSION['rol_id'] == "R") { ?>
							<table class="table table-striped table-hover" id="tabla">
								<thead>
									<th>ID</th>
									<th>Fecha</th>
									<th>Placa</th>
									<th>Cédula</th>
									<th>Empresa</th>
									<!-- <th>Condición de la empresa</th> -->
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Muestra</th>
									<th>Daño</th>
									<th>Humedad</th>
									<th>Impureza</th>
									<th>Cantidad restante</th>
									<th>Peso Salida</th>
									<!-- <th>Cantidad Producto</th> -->
									<th>Silo</th>
									<th>Estado</th>
									<th>Opciones</th>
								</thead>
								<tbody>
								</tbody>
							</table>
						<?php
						}
						if ($_SESSION['rol_id'] == "L") {
						?>
							<div class="text-center">
								<div class="col-6 mx-auto">
									<h1>Vista para laboratorio</h1>
								</div>
							</div>
						<?php } ?>
					</div>
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
		</div>
	</div>
	<?php $this->Component("scripts"); ?>
	<script>
		const consultarModal = async (value) => {
			await fetch("Controlador/Entrada.php?operacion=ConsultarModal&&id=" + value)
				.then(response => response.text())
				.then(result => {
					console.log(value)
					$("#modalConsulta").html(result)
				}).catch(error => console.error(error))
		}
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
						data: "m_Fecha"
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
					// {
					// 	data: "condicion_empresa",
					// 	render(data) {
					// 		if (data == "E") return "Externa";
					// 		else return "Interna";
					// 	}
					// },
					{
						data: "producto_Nombre"
					},
					{
						data: "m_Cantidad",
						render(data) {
							return data + " KG"
						}
					},
					{
						data: "m_Muestra"
					},
					{
						data: "m_Dano"
					},
					{
						data: "m_Humedad",
						render(data) {
							return data + "%"
						}
					},
					{
						data: "m_Impureza",
						render(data) {
							return data + "%"
						}
					},
					{
						data: "m_PesoLab"
					},

					{
						data: "m_pesoFinal",
						render(data) {
							return data + " KG.";
						}
					},
					// {
					// 	data: "m_Total",
					// 	render(data) {
					// 		return data + " KG.";
					// 	}
					// },
					{
						data: "m_Silo"
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
									<a href="#modalConsult" class="edit" data-toggle="modal" onclick="consultarModal('${row.ID}')">
									<i class="material-icons">apps</i>
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
	</script>
</body>

</html>