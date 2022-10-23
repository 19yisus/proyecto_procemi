<?php
  require ("Conexion.php");

  class Movimiento_m extends bd{
    //Variables privadas que solo pueden ser accedidas desde la clase donde se crean
    private $id, $placa, $cedula, $empresa, $producto, $cantidad, $dano, $muestra, $humedad, $pesoFinal, $silo, $estatus, $fecha;
    //Funcion constructora, se ejecuta automaticamente al instanciar la clase 
    //Este se hace para dejar las variables con un string vacio
    public function __construct(){
      $this->id = 
      $this->placa = 
      $this->cedula = 
      $this->empresa = 
      $this->producto = 
      $this->cantidad = 
      $this->dano = 
      $this->muestra =
      $this->humedad =
      $this->pesoFinal =
      $this->silo = 
      $this->estatus =    
      $this->fecha = ""; 
    }
    //Aqui asignamos las variables y le colocamos condicionales de una linea
    public function SetDatos($id, $placa, $cedula, $empresa, $producto, $cantidad, $dano, $muestra, $humedad, $pesoFinal, $silo, $estatus){
      //Basicamente si la variable tiene algo entra en el "?" y retorna el id, si no tiene nada entra en el ":" y retorna null
      $this->id = isset($id) ? $id : null;
      $this->placa = isset($placa) ? $placa : null;
      $this->cedula = isset($cedula) ? $cedula : null;
      $this->empresa = isset($empresa) ? $empresa : null;
      $this->producto = isset($producto) ? $producto : null;
      $this->cantidad = isset($cantidad) ? $cantidad : null;
      $this->dano = isset($dano) ? $dano : null;
      $this->muestra = isset($muestra) ? $muestra : null;
      $this->humedad = isset($humedad) ? $humedad : null;
      $this->pesoFinal = isset($pesoFinal) ? $pesoFinal : null;
      $this->silo = isset($silo) ? $silo : null;
      $this->estatus = isset($estatus) ? $estatus : null;
      $this->fecha = date('m-d-Y');
    }
    //Se hace las operaciones y se retorna un booleano, aqui podemos aplicar mas validaciones para mayor seguridad
    //Por ejemplo validar que la operacion se realizo, y validar si hubo algun tipo de error
    public function Registrar(){     
      try{
        $sql1 = "INSERT INTO movimiento(
          ID_Vehiculo, ID_Personal,
          ID_Empresa, ID_Producto,
          
          m_Silo, m_Estatus, m_Fecha) 
          VALUES (
          '$this->placa','$this->cedula','$this->empresa','$this->producto',
          '$this->silo','$this->estatus',NOW()
          )";

        $con = $this->beginTransaccion();
        $con->query($sql1);
        $id_mov = mysqli_insert_id($con);
          
        $sql2 = "INSERT INTO movimiento_detalles(
          id_detalle,
          m_Cantidad, m_Dano, m_Muestra, m_Humedad,
          m_Impureza, m_PesoLab, m_PesoFinal, m_Total) 
        VALUES (
          '$id_mov',
          '$this->cantidad','$this->dano','$this->muestra','$this->humedad',
          '$this->impureza','$this->pesoLab','$this->pesoFinal','$this->total')";
        $con->query($sql2);
      }catch(Exception $e){
        die($e->getMessage());
      }
    }

    public function Consultar_Todos(){
      $res = $this->ejecutar("SELECT * FROM movimiento")->fetch_all(MYSQLI_ASSOC);
      return $res;
    }
    /* No creo que sea necesario explicar esta parte, basciamente agregue las funciones de consultar todos, actualizar y consultar por id */

    public function Actualizar(){
      $this->ejecutar("UPDATE entrada SET 
      Placa = '$this->placa',
      Cedula = '$this->cedula',
      Empresa = '$this->empresa',
      Producto = $this->producto,
      Cantidad = $this->cantidad,
      Dano = '$this->dano'
      WHERE id = $this->id");
      return true;
    }

    public function Consultar_Uno($id){
      $res = $this->ejecutar("SELECT * FROM entrada WHERE id = $id")->fetch_assoc();
      return $res;
    }

    public function Eliminar(){
      $this->ejecutar("DELETE FROM movimiento WHERE id = $this->id");
      return true;
    }
  }