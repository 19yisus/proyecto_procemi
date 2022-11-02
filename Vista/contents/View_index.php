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
									<h2 class="ml-lg-2">PROCEMI</h2>
								</div>
							</div>
						</div>
						<br>
						<table class="table table-striped table-hover" id="tabla">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>Placa</th>
								<th>Cédula</th>
								<th>Empresa</th>
								<th>Condición de la empresa</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Muestra</th>
								<th>Daño</th>
								<th>Humedad</th>
								<th>Impureza</th>
								<th>Total</th>
								<th>Peso Salida</th>
								<th>Cantidad Producto</th>
								<th>Silo</th>
								<th>Estado</th>
								<th>Opciones</th>
							</thead>
							<tbody>
							</tbody>
						</table>

						<!-- <img src="<?php //$this->Assets('img/logo.jpg'); 
														?>" width="300" class="img-fluid" /> -->
						<!-- <div class="products-container">
								<div class="product" data-name="p-1">
									<img src="images/1.png" alt="">
									<h3>Silo 1</h3>

								</div>

								<div class="product" data-name="p-2">
									<img src="images/2.png" alt="">
									<h3>Silo 2</h3>

								</div>

								<div class="product" data-name="p-3">
									<img src="images/3.png" alt="">
									<h3>Silo 3</h3>

								</div>

								<div class="product" data-name="p-4">
									<img src="images/4.png" alt="">
									<h3>Silo 4</h3>

								</div>



							</div> -->

						<!-- <div class="products-preview">

								<div class="preview" data-target="p-1">
									<i class="fas fa-times"></i>
									<img src="images/1.png" alt="">
									<h3>Silo 1</h3>
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>

									</div>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
									<div class="price">/2.500</div>
									<div class="buttons">

									</div>
								</div>

								<div class="preview" data-target="p-2">
									<i class="fas fa-times"></i>
									<img src="images/2.png" alt="">
									<h3>Silo 2</h3>
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>

									</div>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
									<div class="price">/2.500</div>
									<div class="buttons">

									</div>
								</div>

								<div class="preview" data-target="p-3">
									<i class="fas fa-times"></i>
									<img src="images/3.png" alt="">
									<h3>Silo 3</h3>
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>

									</div>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
									<div class="price">/2.500</div>
									<div class="buttons">

									</div>
								</div>

								<div class="preview" data-target="p-4">
									<i class="fas fa-times"></i>
									<img src="images/4.png" alt="">
									<h3>Silo 4</h3>
									<div class="stars">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>

									</div>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
									<div class="price">/2.500</div>
									<div class="buttons">

									</div>
								</div>
							</div> -->
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
						data: "empresa_Nombre"
					},
					{
						data: "condicion_empresa",
						render(data) {
							if (data == "E") return "Externa";
							else return "Interna";
						}
					},
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
						data: "m_Humedad"
					},
					{
						data: "m_Impureza"
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
					{
						data: "m_Total",
						render(data) {
							return data + " KG.";
						}
					},
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
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
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