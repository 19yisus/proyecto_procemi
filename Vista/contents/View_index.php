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
									<h2 class="ml-lg-2">Silos</h2>
								</div>
							</div>
						</div>
						<br>
						<div class="container">
							<div class="products-container">
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



							</div>

							<div class="products-preview">

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