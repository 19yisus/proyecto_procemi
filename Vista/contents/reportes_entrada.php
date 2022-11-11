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
        <!-- custom css file link  -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/reportes.css">
  

    
    <!--google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


   <!--google material icon-->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- custom js file link  -->
   <script src="js/script.js" defer></script>
   <script src="https://kit.fontawesome.com/c8989fb264.js" crossorigin="anonymous"></script>
			<!------Tabla-----------> 
			
         <div class="main-content">
                <div class="row">
                   <div class="col-md-12">
                      <div class="table-wrapper">
                        
                      <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                               <h2 class="ml-lg-2">Reportes de Entrada</h2>
                            </div>
                        </div>
                    </div>
                    <br>

                        <div class="fecha">
                            <label>Desde: </label>
                             <input type="date" name="" id="ent">
                             <label>Hasta:</label>
                             <input type="date" name="" id="hasta">
                             <button id="b">Generar reporte     <i class="fa-solid fa-download"></i></button>
                        </div>

   <!-- Tabla -->
   <table class="table table-striped table-hover" id="tabla">
						<thead>
                     <th>Fecha</th>
							<th>ID</th>
							<th>Placa</th>
							<th>Cédula</th>
							<th>Empresa</th>
							<th>Producto</th>
							<th>Cantidad</th>
                     <th>Daño</th>
                     <th>Muestra</th>
                     <th>Humedad</th>
                     <th>Impureza</th>
                     <th>Cantidad Total</th>
                     <th>Silo</th>
						</thead>
						<tbody>
						</tbody>
					</table>
           <!----Panel inferior------------->
                                               
           <footer class="footer">
            <div class="container-fluid">
               <div class="footer-in">
                  <p class="mb-0">&copy 2022 PROCEMI. All Rights Reserved.</p>
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
						"url": "../Controlador/Entrada.php?operacion=ConsultarTodos",
						"dataSrc": "data"
					},
					"columns":[
						{data: "ID"},
						{data: "vehiculo_Placa"},
						{data: "personal_Cedula"},
						{data: "empresa_Nombre"},
						{data: "producto_Nombre"},
						{data: "m_Cantidad"},
						{defaultContent: "",
							render(data, type, row){
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
				})	
			})
  	</script>


</div>
  </body>
  
                         <!--JavaScript -->
                        <!-- Bootstrap JS -->
                        <script src="js/jquery-3.3.1.slim.min.js"></script>
                       <script src="js/popper.min.js"></script>
                       <script src="js/bootstrap.min.js"></script>
                       <script src="js/jquery-3.3.1.min.js"></script>
                      
</html>