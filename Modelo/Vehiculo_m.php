<?php
  require ("Conexion.php");

  class Vehiculo_m extends bd{
    //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
    private $id, $placa, $modelo, $empresa, $color, $peso, $ano, $fecha, $Vehiculo_PesoSecundario, $if_doble, $condicion, $rif_dueno, $segundaPlaca;
    //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
    //Este se hace para dejar las variables con un string vacio
    public function __construct(){
      $this->id = $this->placa = $this->if_doble = $this->Vehiculo_PesoSecundario = $this->modelo = $this->condicion = $this->rif_dueno = $this->color = $this->peso = $this->ano = $this->fecha = $this->segundaPlaca = ""; 
    }
    //Aqui asignamos las variables y le colocamos condicionales de una linea
    public function SetDatos($id, $placa, $modelo, $empresa, $color, $peso, $ano, $if_doble, $extra, $condicion, $rifDueno, $segundaPlaca){
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
    //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
    //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
    public function Registrar(){
      $res = $this->ejecutar("SELECT * FROM vehiculo WHERE vehiculo_Placa = '$this->placa';")->fetch_all(MYSQLI_ASSOC);

      if(isset($res[0])) return 5;
      
      $sql = "INSERT INTO vehiculo(vehiculo_Placa,segunda_Placa,rif_dueno,vehiculo_Peso,vehiculo_Ano,condicion,If_doble,Vehiculo_PesoSecundario,vehiculo_Estatus,vehiculo_Fecha,ID_Modelo,ID_Color,ID_Empresa)
      VALUES ('$this->placa',$this->segundaPlaca,'$this->rif_dueno',$this->peso,'$this->ano','$this->condicion','$this->if_doble',$this->Vehiculo_PesoSecundario,true,NOW(),$this->modelo,$this->color,$this->empresa)";
      
      $result = $this->ejecutar($sql);
      return $result;
    }

    public function Consultar_Todos(){
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
      if($res) $res = $res->fetch_all(MYSQLI_ASSOC); else $res = [];
      return $res;
    }
    /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

    public function Actualizar(){
      $this->ejecutar("UPDATE vehiculo SET 
      vehiculo_Placa = '$this->placa', 
      vehiculo_Peso = '$this->peso',
      vehiculo_Ano = '$this->ano',
      ID_Modelo = $this->modelo,
      ID_Color = $this->color,
      If_doble = '$this->if_doble',
      Vehiculo_PesoSecundario = '$this->Vehiculo_PesoSecundario'
      WHERE ID = $this->id");
      return true;
    }

    public function Consultar_Uno($id){
      $res = $this->ejecutar("SELECT * FROM vehiculo WHERE id = $id")->fetch_assoc();
      return $res;
    }

    public function Eliminar(){
      $this->ejecutar("UPDATE vehiculo SET vehiculo_Estatus = false WHERE id = $this->id");
      return true;
    }

    public function ConsultarPlaca($placa){
      $res = $this->ejecutar("SELECT * FROM vehiculo WHERE vehiculo_Placa = $placa")->fetch_assoc();
      return $res;
    }

    public function ConsultPorEmpresa($id){
      $res = $this->ejecutar("SELECT * FROM vehiculo WHERE ID_Empresa = $id");
      if($res) $res = $res->fetch_all(MYSQLI_ASSOC); else $res = [];
      return $res;
    }

  }