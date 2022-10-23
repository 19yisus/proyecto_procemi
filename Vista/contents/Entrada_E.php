<!-- Para empezar, optimice las lineas de codigo, y le di identacion al codigo para que se va mas ordenao y legible, como veras varias secciones de la pagina ya no estan.
	A estas secciones las estoy trabajando como componentes reutilizable, para no tener el mismo codigo repetido en todas las paginas -->
    <!doctype html>
<html lang="en">
<?php require("./includes/header.php");?>
  <body>
		<?php require("./includes/menu.php");?>
   	<!------------>	
    <!-----Contenido----------->
    <div id="content">
			<!------PANEL SUPERIOR----------->    
		  <?php require("./includes/navbar.php");?>
			<!------Tabla-----------> 
			<div class="main-content">
				<div class="row">
					<div class="col-md-12">
					<div class="table-wrapper">
						<div class="table-title">
						<div class="row">
							<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
								<h2 class="ml-lg-2">Entrdas Eliminadas</h2>
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
							<th>Daño</th>
							<th>Opciones</th>
						</thead>
						<tbody>
						</tbody>
					</table>
					<!-- fIN de la tabla -->
				</div>
			</div>
			
			<!----Recuperar--------->
			<form action="../Controlador/Entrada.php" method="post">
				<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Recuperar</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>¿Está seguro de que desea Recuperar este registro?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<input type="hidden" name="ID" id="ID" class="ID">
								<input type="hidden" name="operacion" value="Recuperar">
								<button type="submit" name="Recuperar" class="btn btn-success">Recuperar</button>
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
		<?php error_reporting (0); require("./includes/scripts.php");?>
  	<script type="text/javascript">
			$(document).ready( ()=>{
				/* Creamos el datatable y por medio de la propiedad ajax, le damos la url a consultar y asignamos la propiedad dataSrc, le damos el valor data (ya que es lo que mando desde el controlador)
				 asigno las columnas donde van, y agrego los botones con su evento onclick para las operaciones
				 */
				$("#tabla").DataTable({
					"ajax":{
						"url": "../Controlador/Entrada.php?operacion=Consultar_E",
						"dataSrc": "data"
					},
					"columns":[
						{data: "ID"},
						{data: "vehiculo_Placa"},
						{data: "personal_Cedula"},
						{data: "empresa_Nombre"},
						{data: "producto_Nombre"},
						{data: "m_Cantidad"},
						{data: "m_Dano"},
						{defaultContent: "",
							render(data, type, row){
								let btn = `
									<a href="#deleteEmployeeModal" class="Delete" id="delete" data-toggle="modal" onclick="Recuperar('${row.ID}')">
									<i class="material-icons">&#xE147;</i>
									</a>`;

								return btn;
							}
						}
					],
				})	
			})
			/* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
			const Recuperar = (id) => $(".ID").val(id)
			/* El codigo de aqui abajo lo comente porque no le vi la utilidad, osea, lo comente y no vi cambios */	
  	</script>
  </body>
</html>