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
		

		<!-- Maria -->
						<div class="principal">
							<div class="reseña">
								<h1>Reseña Historica</h1>
								<p>En el año 2015 el agro-productor William Salazar comenzó con su gran proyecto que se trataba en elaborar un conjunto de silos, para almacenar toda su producción de productos agrícolas, se comenzó construyendo distintos galpones para guardar materias, luego un conjunto de oficinas para   llevar todo supervisado el trabajo la cuál finalizo en el año 2018 con la construcción de 4 silos y habitación de análisis, actualmente se encuentra en la construcción de la cerca de entrada a la planta.</p>
							</div>

							<div class="house-page">
								<div class="card">

									<div class="icon">
										<i class="material-icons md-36">local_shipping</i>

									</div>
									<p class="title">Entrada de vehiculos</p>

								</div>

								<!-----tarjeta 2---->
								<div class="card">
									<div class="icon">
										<i class="material-icons md-36">science</i>
									</div>
									<p class="title">Analisis del producto</p>

								</div>


								<!-----tarjeta 3---->
								<div class="card">
									<div class="icon">
										<i class="material-icons md-36">corporate_fare</i>

									</div>
									<p class="title">Almacenamiento del producto</p>

								</div>
							</div>

							<div class="maps">
								




								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3935.166377226718!2d-69.2892083807671!3d9.494254420165346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e7db89d36080f61%3A0x6f3f1d47be256ac!2sProcemi!5e0!3m2!1ses!2sve!4v1668560521237!5m2!1ses!2sve" width="400" height="300" style="border:1px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

							</div>
						</div>

	<?php $this->Component("scripts"); ?>
</body>

</html>