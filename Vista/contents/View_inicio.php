<?php
include("../Modelo/Conexion.php");
$a = new bd();

$silo1 = $a->ejecutar("SELECT movimiento.m_Total, producto.producto_Nombre FROM movimiento 
   INNER JOIN producto ON producto.ID = movimiento.ID_producto
   WHERE m_Silo = '1'");

$silo2 = $a->ejecutar("SELECT movimiento.m_Total, producto.producto_Nombre FROM movimiento 
   INNER JOIN producto ON producto.ID = movimiento.ID_producto
   WHERE m_Silo = '2'");

$silo3 = $a->ejecutar("SELECT movimiento.m_Total, producto.producto_Nombre FROM movimiento 
   INNER JOIN producto ON producto.ID = movimiento.ID_producto
   WHERE m_Silo = '3'");

$silo4 = $a->ejecutar("SELECT movimiento.m_Total, producto.producto_Nombre FROM movimiento 
   INNER JOIN producto ON producto.ID = movimiento.ID_producto
   WHERE m_Silo = '4'");

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
		<!-- custom css file link  -->
		<link rel="stylesheet" href="<?php $this->Assets('css/style.css');?>">
		<!-- custom js file link  -->
		<script src="<?php $this->Assets('js/script.js');?>" defer></script>

		<!------Tabla----------->
		<div class="main-content">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrapper">
						<div class="table-title">
							<div class="row">
								<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
									<h2 class="ml-lg-2">Silos</h2>
								</div>
							</div>
						</div>
						<div class="container">
							<div class="products-container">

								<div class="product" data-name="p-1">
									<img src="images/1.png" alt="">
									<h3>Silo 1</h3>
									<br>
									<h4>Producto :
										<?php
										while ($s = $silo1->fetch_assoc()) {
											echo $s["producto_Nombre"];
										?>
											<br>
											Cantidad:
											<?php
											echo $s["m_Total"];
											?>
											/25.000.000
										<?php
										}
										?>
									</h4>

								</div>

								<div class="product" data-name="p-2">
									<img src="images/2.png" alt="">
									<h3>Silo 2</h3>
									<br>
									<h4>Producto :
										<?php
										while ($s = $silo2->fetch_assoc()) {
											echo $s["producto_Nombre"];
										?>
											<br>
											Cantidad:
											<?php
											echo $s["m_Total"];
											?>
											/25.000.000
										<?php
										}
										?>
									</h4>

								</div>

								<div class="product" data-name="p-3">
									<img src="images/3.png" alt="">
									<h3>Silo 3</h3>
									<br>
									<h4>Producto :
										<?php
										while ($s = $silo3->fetch_assoc()) {
											echo $s["producto_Nombre"];
										?>
											<br>
											Cantidad:
											<?php
											echo $s["m_Total"];
											?>
											/25.000.000
										<?php
										}
										?>
									</h4>

								</div>

								<div class="product" data-name="p-4">
									<img src="images/4.png" alt="">
									<h3>Silo 4</h3>
									<br>
									<h4>Producto :
										<?php
										while ($s = $silo4->fetch_assoc()) {
											echo $s["producto_Nombre"];
										?>
											<br>
											Cantidad:
											<?php
											echo $s["m_Total"];
											?>
											/25.000.000
										<?php
										}
										?>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->Component("scripts"); ?>
</body>
</html>