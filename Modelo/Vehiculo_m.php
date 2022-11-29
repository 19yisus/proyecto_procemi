<?php
require("Conexion.php");

class Vehiculo_m extends bd
{
  //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
  private $id, $placa, $modelo, $empresa, $color, $peso, $ano, $fecha, $Vehiculo_PesoSecundario, $if_doble, $condicion, $rif_dueno, $segundaPlaca, $nombre_dueno, $correo_dueno, $dire_dueno, $telefono;
  //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
  //Este se hace para dejar las variables con un string vacio
  public function __construct()
  {
    $this->id = $this->placa = $this->if_doble = $this->Vehiculo_PesoSecundario = $this->modelo = $this->condicion = $this->rif_dueno = $this->color = $this->peso = $this->ano = $this->fecha = $this->segundaPlaca = "";
    $this->nombre_dueno = $this->correo_dueno = $this->dire_dueno = $this->telefono = "";
  }
  //Aqui asignamos las variables y le colocamos condicionales de una linea
  public function SetDatos($id, $placa, $modelo, $empresa, $color, $peso, $ano, $if_doble, $extra, $condicion, $rifDueno, $segundaPlaca)
  {
    //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
    $this->id = isset($id) ? $id : null;
    $this->placa = isset($placa) ? $placa : null;
    $this->modelo = isset($modelo) ? $modelo : null;
    $this->empresa = isset($empresa) ? $empresa : "NULL";
    $this->rif_dueno = isset($rifDueno) ? $rifDueno : "NULL";
    $this->color = isset($color) ? $color : null;
    $this->peso = isset($peso) ? $peso : null;
    $this->ano = isset($ano) ? $ano : null;
    $this->fecha = date('m-d-Y');
    $this->Vehiculo_PesoSecundario = isset($extra) ? $extra : null;
    $this->segundaPlaca = isset($segundaPlaca) ? "'$segundaPlaca'" : "NULL";
    $this->if_doble = isset($if_doble) ? $if_doble : null;
    $this->condicion = isset($condicion) ? $condicion : null;
  }

  public function GuardarDatos($d)
  {
    $this->id = isset($d['ID']) ? $d['ID'] : null;
    $this->placa = isset($d['Placa']) ? $d['Placa'] : null;
    $this->modelo = isset($d['Modelo']) ? $d['Modelo'] : null;
    $this->empresa = isset($d['Empresa']) ? $d['Empresa'] : "NULL";
    $this->rif_dueno = isset($d['rif_dueno']) ? $_POST['tipoRif'] . "-" . $_POST['rif_dueno'] : "NULL";
    $this->color = isset($d['Color']) ? $d['Color'] : null;
    $this->peso = 0;
    $this->Vehiculo_PesoSecundario = 0;
    $this->ano = isset($d['Ano']) ? $d['Ano'] : null;
    $this->fecha = date('m-d-Y');
    $this->segundaPlaca = isset($d['segunda_Placa']) ? $d['segunda_Placa'] : "NULL";
    $this->if_doble = isset($d['if_doble']) ? $d['if_doble'] : 0;
    $this->condicion = isset($d['condicion']) ? $d['condicion'] : null;
    $this->nombre_dueno = isset($d['nombre_dueno']) ? $d['nombre_dueno'] : null;
    $this->correo_dueno = isset($d['correo_dueno']) ? $d['correo_dueno'] : null;
    $this->dire_dueno = isset($d['dire_dueno']) ? $d['dire_dueno'] : null;
    $this->telefono = isset($d['telefono_dueno']) ? $d['telefono_dueno'] : null;
  }

  public function Registrar()
  {
    $sql = "INSERT INTO vehiculo(
        vehiculo_Placa,segunda_Placa,
        rif_dueno,vehiculo_Peso,vehiculo_Ano,condicion,
        If_doble,Vehiculo_PesoSecundario,vehiculo_Estatus,
        vehiculo_Fecha,ID_Modelo,ID_Color,ID_Empresa,
        nombre_dueno,dire_dueno,correo_dueno,telefono_dueno)
      VALUES (
        '$this->placa',$this->segundaPlaca,'$this->rif_dueno',$this->peso,
        '$this->ano','$this->condicion','$this->if_doble',$this->Vehiculo_PesoSecundario,
        true,NOW(),$this->modelo,$this->color,$this->empresa,
        '$this->nombre_dueno','$this->correo_dueno','$this->dire_dueno','$this->telefono')";

    $result = $this->ejecutar($sql);
    return $result;
  }

  public function Consultar_Todos()
  {
    $res = $this->ejecutar("SELECT 
      vehiculo.*, 
      marca.marca_Nombre, 
      modelo.modelo_Nombre, 
      color.color_Nombre, 
      vehiculo.vehiculo_Peso, 
      vehiculo.vehiculo_Ano,
      vehiculo.segunda_Placa, 
      empresa.empresa_Nombre 
      FROM vehiculo 
      INNER JOIN modelo ON modelo.ID = vehiculo.ID_Modelo
      INNER JOIN color on color.ID = vehiculo.ID_Color  
      INNER JOIN marca on marca.ID = modelo.ID_Marca  
      LEFT JOIN empresa on empresa.ID = vehiculo.ID_Empresa  
      WHERE vehiculo_Estatus = true");
    if ($res) $res = $res->fetch_all(MYSQLI_ASSOC);
    else $res = [];
    return $res;
  }


  public function Actualizar()
  {
    $res = $this->ejecutar("SELECT * FROM movimiento WHERE ID_Vehiculo = $this->id");
    $res = $res->fetch_assoc();
    if ($res != "" || $res != null) {
      return false;
    } else {
      $this->ejecutar("UPDATE vehiculo SET 
      rif_dueno = '$this->rif_dueno',
      condicion = '$this->condicion',
      vehiculo_Placa = UPPER('$this->placa'), 
      vehiculo_Peso = '$this->peso',
      vehiculo_Ano = '$this->ano',
      ID_Modelo = UPPER($this->modelo),
      ID_Color = UPPER($this->color),
      If_doble = '$this->if_doble',
      ID_Empresa = $this->empresa,
      Vehiculo_PesoSecundario = '$this->Vehiculo_PesoSecundario',
      nombre_dueno = '$this->nombre_dueno',
      dire_dueno = '$this->dire_dueno',
      correo_dueno = '$this->correo_dueno',
      telefono_dueno = '$this->telefono'
      WHERE ID = $this->id");
      return true;
    }
  }

  public function Consultar_Uno($id)
  {
    $res = $this->ejecutar("SELECT * FROM vehiculo WHERE id = $id")->fetch_assoc();
    return $res;
  }

  public function Eliminar()
  {
    $res = $this->ejecutar("SELECT * FROM movimiento WHERE ID_Vehiculo = $this->id");
    $res = $res->fetch_assoc();
    if ($res != "" || $res != null) {
      return false;
    } else {
      $this->ejecutar("UPDATE vehiculo SET vehiculo_Estatus = false WHERE id = $this->id");
      return true;
    }
  }

  public function Consultar_E()
  {
    $res = $this->ejecutar("SELECT 
      vehiculo.*, 
      marca.marca_Nombre, 
      modelo.modelo_Nombre, 
      color.color_Nombre, 
      vehiculo.vehiculo_Peso, 
      vehiculo.vehiculo_Ano,
      vehiculo.segunda_Placa, 
      empresa.empresa_Nombre 
      FROM vehiculo 
      INNER JOIN modelo ON modelo.ID = vehiculo.ID_Modelo
      INNER JOIN color on color.ID = vehiculo.ID_Color  
      INNER JOIN marca on marca.ID = modelo.ID_Marca  
      LEFT JOIN empresa on empresa.ID = vehiculo.ID_Empresa  
      WHERE vehiculo_Estatus = false");
    if ($res) $res = $res->fetch_all(MYSQLI_ASSOC);
    else $res = [];
    return $res;
  }

  public function Recuperar()
  {
    $this->ejecutar("UPDATE vehiculo SET vehiculo_Estatus = true WHERE id = $this->id");
    return true;
  }

  public function ConsultarPlaca($placa)
  {
    $res = $this->ejecutar("SELECT * FROM vehiculo WHERE vehiculo_Placa = '$placa'");
    if ($res) $res = $res->fetch_assoc();
    else $res = ["SELECT * FROM vehiculo WHERE vehiculo_Placa = '$placa'"];
    return $res;
  }

  public function ConsultarCedula($cedula)
  {
    $rif = "J-" . $cedula;
    $ced = "V-" . $cedula;

    // Empresa
    $res = $this->ejecutar("SELECT * FROM empresa WHERE (empresa_Rif = '$rif') OR (empresa_cedulaE = '$ced') OR (empresa_cedulaE = '$rif')");
    $res = $res->fetch_assoc();

    // Persoanl
    $res2 = $this->ejecutar("SELECT * FROM personal WHERE personal_Cedula = '$cedula'");
    $res2 = $res2->fetch_assoc();

    // Usuarios
    $res3 = $this->ejecutar("SELECT * FROM usuarios WHERE cedula_user = '$cedula'");
    $res3 = $res3->fetch_assoc();

    // Vehiculo
    $res4 = $this->ejecutar("SELECT * FROM vehiculo WHERE (rif_dueno ='$rif') OR (rif_dueno = '$ced')");
    $res4 = $res4->fetch_assoc();

    switch (true) {
      case $res != "" || $res != null:
        return "El dato que estas ingresado ya esta registrado en otra empresa";
      case $res2 != "" || $res2 != null:
        return "El dato que estas ingresando ya esta registrado en un personal";
      case $res3 != "" || $res3 != null:
        return "El dato que estas ingresando ya esta registrado en un usuario del sistema";
      case $res4 != "" || $res4 != null:
        return "El dato que estas ingresando ya esta registrado en un vehiculo";
      default:
        return;
    }
  }

  public function ConsultPorEmpresa($id)
  {
    $res = $this->ejecutar("SELECT * FROM vehiculo WHERE ID_Empresa = $id");
    if ($res) $res = $res->fetch_all(MYSQLI_ASSOC);
    else $res = [];
    return $res;
  }

  public function ConsultarVehiculo($nombre)
  {
    $res = $this->ejecutar("SELECT * FROM marca WHERE marca_Nombre = '$nombre'");
    if ($res) $res = $res->fetch_assoc();
    else $res = ["SELECT * FROM marca WHERE marca_Nombre = '$nombre'"];
    return $res;
  }
}
