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
                  <h2 class="ml-lg-2 text-light">Usuarios del sistema</h2>
                </div>
                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                  <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" onclick="crear_usuario()">
                    <i class="material-icons">&#xE147;</i>
                    <span></span>
                  </a>
                  <!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                    <i class="material-icons">&#xE15C;</i>
                    <span></span>
                  </a> -->
                </div>
              </div>
            </div>
            <!-- formulario para la desactivacion de usuarios -->
            <form style="display: none;" action="Controlador/Auth.php" method="post" id="form_desactivacion">
              <input type="hidden" name="id" id="id_desac">
              <input type="hidden" name="estatus" id="status_desac">
              <input type="hidden" name="operacion" value="cambiarStatus">
            </form>
            <!-- Tabla -->
            <table class="table table-striped table-hover" id="tabla">
              <thead>
                <th>ID</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Opciones</th>
              </thead>
              <tbody>
              </tbody>
            </table>
            <!-- fIN de la tabla -->
          </div>
        </div>
        <!----Formulario emergente--------->
        <form action="Controlador/Auth.php" method="post">
          <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Usuarios</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Cédula</label>
                        <div class="input-group">
                          <div class="pretend">
                            <select name="Nacionalidad" id="Nacionalidad" class="form-control">
                              <option value="V">V</option>
                              <option value="E">E</option>
                            </select>
                          </div>
                          <input type="hidden" name="id" id="id">
                          <input type="text" pattern="[0-9]{7,8}" maxlength="8" minlength="7" name="cedula_user" id="cedula" title="Solo se pueden ingresar caracteres númericos" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Nombre y Apellido</label>
                        <input type="text" minlength="2" maxlength="60" name="nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" id="nombre" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Télefono</label>
                        <div class="input-group">
                          <div class="pretend">
                            <select name="codigo_area" id="codigo_area" class="form-control">
                              <option value="0412">0412</option>
                              <option value="0416">0416</option>
                              <option value="0416">0426</option>
                              <option value="0414">0414</option>
                              <option value="0424">0424</option>
                            </select>
                          </div>
                          <input type="tel" pattern="[0-9]{7}" title="Solo se aceptan numeros" maxlength="7" minlength="7" name="Telefono" id="telefono" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Correo</label>
                        <input type="email" maxlength="120" minlength="20" name="Correo" id="correo" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="Direccion" id="direccion" class="form-control" title="Solo se pueden ingresar caracteres numericos y alfabeticos" required>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Clave</label>
                        <input type="password" minlength="8" maxlength="8" name="clave_user" id="clave" class="form-control" required>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex flex-column">
                        <label for="">Rol del usuario</label>
                        <div class="d-flex flex-row justify-content-around">
                          <div class="form-check ml-2 mr-2">
                            <input type="radio" name="rol" value="R" id="rol" class="form-check-input" required>
                            <small class="form-check-label">Romanero</small>
                          </div>
                          <div class="form-check">
                            <input type="radio" name="rol" value="L" id="rol" class="form-check-input" required>
                            <small class="form-check-label">Laboratorio</small>
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
                </div>
              </div>
            </div>
          </div>
        </form>
        <!----Eliminar Datos--------->
        <form action="Controlador/Cargo.php" method="post">
          <div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Eliminar Registro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Está seguro de que desea eliminar este registro?</p>
                  <p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <input type="hidden" name="ID" id="id" class="ID">
                  <input type="hidden" name="operacion" value="Eliminar">
                  <button type="submit" name="Eliminar" class="btn btn-success">Eliminar</button>
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
    <?php $this->Component("scripts"); ?>
    <script type="text/javascript">
      
      $("#telefono").on("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
      })


      $("#cedula").on("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
      })

      $("#nombre").on("input", function() {
        this.value = this.value.replace(/[^a-z-A-ZÀ-ÿ\u00f1\u00d1]/g, '');
      })

      document.getElementById("cedula").addEventListener("keyup", async (e) => {
        if (e.target.value.length > 7) {
          $("#Nacionalidad option[value='E']").attr("selected", true);
        } else {
          $("#Nacionalidad option[value='E']").attr("selected", false);
        }
      })

      document.getElementById("cedula").addEventListener("keyup", async (e) => {
        if (e.target.value.length >= 4) {
          await fetch(`Controlador/Auth.php?operacion=ConsultarCedula&&cedula=${e.target.value}`)
            .then(response => response.json())
            .then(result => {
              if (result.data) {
                alert(result.data)
                $("#cedula").val("");
              }
            }).catch(error => console.error(error))
        }
      })
      $(document).ready(() => {
        /* Creamos el datatable y por medio de la propiedad ajax, le damos la url a consultar y asignamos la propiedad dataSrc, le damos el valor data (ya que es lo que mando desde el controlador)
         asigno las columnas donde van, y agrego los botones con su evento onclick para las operaciones
         */
        $("#tabla").DataTable({
          "ajax": {
            "url": "Controlador/Auth.php?operacion=ConsultarTodos",
            "dataSrc": "data"
          },
          "columns": [{
              data: "id_usuario"
            },
            {
              data: "cedula_user"
            },
            {
              data: "nombre"
            },
            {
              data: "rol_user",
              render(data) {
                if (data == "A") return "ADMINISTRADOR";
                if (data == "R") return "ROMANERO";
                if (data == "L") return "LABORATORIO";
              }
            },
            {
              data: "estatus_user",
              render(data) {
                if (data) return "Activo"
              }
            },
            {
              data: "fecha_user"
            },
            {
              defaultContent: "",
              render(data, type, row) {
                let btn = `
									<a href="#addEmployeeModal" class="edit" data-toggle="modal" onclick="consultarUno('${row.ID}')">
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									</a>
									<a href="#deleteEmployeeModal" class="delete" id="delete" data-toggle="modal" onclick="Eliminar('${row.ID}')">
										<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
									</a>`;
                let sms = (row.estatus_user == 1) ? "Desactivar" : "Activar";
                let color = (row.estatus_user == 1) ? "success" : "danger";
                let btn_desactivar = `
                  <button type="button" class="btn btn-${color}" onclick="cambiarEstatus('${row.id_usuario}',${row.estatus_user})">
                    ${sms}
                  </button>
                  <a href="#addEmployeeModal" class="edit" data-toggle="modal" onclick="consultarUno('${row.id_usuario}')">
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									</a>`;

                if (row.rol_user != "A") {
                  return btn_desactivar;
                }
              }
            }
          ],
          language: {
            url: `Vista/js/DataTable.config.json`
          }
        })
      })
      /* 
      	Basicamente definimos una variable consultarUno, donde almacenamoso una funcion, literalmente estoy creando una funcion de una manera difernte
      	dentro de dicha funcion primero asigno la operacion que vamos a realizar (la de actualizar)	
      	Luego hago uso de la funcion fetch para consultar al controlador por medio de js, piensa que es como usar ajax, bueno dicha peticion retorna, y 
      	le asignamos que nos retorne un json (response.json()), luego nos response con un result (podemos colocar cualquier variable dentro, pero yo coloco un objeto
      	para extraer lo que quiero directamente, osea la propiedad data, en dicha propiedad vienen los datos, en el controlador veras como esta esa parte)
      */
      const consultarUno = async (id) => {
        $("#operacion").val("Actualizar");
        await fetch("Controlador/Auth.php?operacion=ConsultarUno&&id=" + id)
          .then(response => response.json())
          .then(({
            data
          }) => {
            console.log(data)
            $("#id").val(data.id_usuario)
            $("#cedula").val(data.cedula_user)
            $("#Nacionalidad").val(data.Nacionalidad)
            $("#nombre").val(data.nombre)
            $("#correo").val(data.Correo)
            $("#direccion").val(data.Direccion)
            let [codigo, telefono] = data.telefono.split("-");
            $("#codigo_area").val(codigo);
            $("#telefono").val(telefono);
            document.querySelectorAll("#rol").forEach(item => {
              if (item.value == data.rol_user) item.checked = true;
            })
          }).catch(error => console.error(error))
      }
      const cambiarEstatus = (id, estado) => {
        $("#id_desac").val(id);
        if (estado == 1) estado = 0;
        else estado = 1
        $("#status_desac").val(estado);
        $("#form_desactivacion").submit();
      }
      /* Bueno, en estas dos funciones solo estamos asignando valores, pero son funciones mas cortas ya que solo realizamos una accion */
      const crear_usuario = () => $("#operacion").val("Registro")
      const Eliminar = (id) => $(".ID").val(id)
      /* El codigo de aqui abajo lo comente porque no le vi la utilidad, osea, lo comente y no vi cambios */
    </script>
</body>

</html>