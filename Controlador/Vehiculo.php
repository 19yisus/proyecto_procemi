<?php
   include("../Modelo/Vehiculo_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_vehiculo();
         break;

         case 'Actualizar':
            actualizar_vehiculo();
         break;

         case 'Eliminar':
            eliminar_vehiculo();
         break;

         case 'Recuperar':
            Recuperar();
         break;

         default:
            echo "No es valida la peticion";
         break;
      }
   }
   //Operaciones de consulta por el metodo get
   if(isset($_GET["operacion"])){
      $consulta = $_GET["operacion"];
      switch($consulta){
         case 'ConsultarTodos':
            consultar_vehiculos();
         break;

         case 'Consultar_E':
            Consultar_E();
         break;   

         case 'ConsultarUno':
            consultar_uno();
         break;

         case 'ConsultarPlaca':
            ConsultarPlaca();
         break;

         case 'ConsultPorEmpresa':
            consultarPorEmpresa();
         break;

         case 'ConsultarPlaca':
            consultarPlaca();
         break;

         case 'ConsultarCedula':
            consultarCedula();
         break;
         
         default:
            echo "No es valida la peticion";
         break;
      }
   }      

   function registrar_vehiculo(){
      // var_dump($_POST);
      // die("FF");
      $a = new Vehiculo_m();
      // if(isset($_POST['rif_dueno'])){
      //    $rif = $_POST['tipoRif']."-".$_POST['rif_dueno'];
      // }else $rif = null;
      // if(!isset($_POST['if_doble'])) $if_doble = 0; else $if_doble = $_POST['if_doble'];
      // if(!isset($_POST['segunda_Placa'])) $segundaPlaca = null; else $segundaPlaca = $_POST['segunda_Placa'];
      // if(!isset($_POST["Empresa"])) $empresa = null; else $empresa = $_POST["Empresa"];
      // $a->SetDatos(null,$_POST["Placa"],$_POST["Modelo"],$empresa,$_POST["Color"],0,$_POST["Ano"],$if_doble,0,$_POST['condicion'],$rif, $segundaPlaca);

      $a->GuardarDatos($_POST);
      $res = $a->Registrar();
      if($res === 5) header("location:../View_Vehiculo?Mensaje=5");
      if($res) header("location:../View_Vehiculo?Mensaje=2");
      else header("location:../View_Vehiculo?Mensaje= 1 ");
   }

   function actualizar_vehiculo(){
      $a = new Vehiculo_m();
      // if(isset($_POST['rif_dueno'])){
      //    $rif = $_POST['tipoRif']."-".$_POST['rif_dueno'];
      // }else $rif = null;
      // if(!isset($_POST['if_doble'])) $if_doble = 0; else $if_doble = $_POST['if_doble'];
      // if(!isset($_POST['segunda_Placa'])) $segundaPlaca = null; else $segundaPlaca = $_POST['segunda_Placa'];
      // if(!isset($_POST['Vehiculo_PesoSecundario'])) $pesoExtra = 0; else $pesoExtra = $_POST['Vehiculo_PesoSecundario'];
      // if(!isset($_POST["Empresa"])) $empresa = null; else $empresa = $_POST["Empresa"];
      // $a->SetDatos($_POST["ID"],$_POST["Placa"],$_POST["Modelo"],$empresa,$_POST["Color"],0,$_POST["Ano"],$if_doble,0,$_POST['condicion'],$rif, $segundaPlaca);
      $a->GuardarDatos($_POST);
      $res = $a->Actualizar();
      if($res == true) header("location:../View_Vehiculo?Mensaje=2");
      else header("location:../View_Vehiculo?Mensaje=8");
   }

   function consultar_vehiculos(){
      $a = new Vehiculo_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }
   function consultar_uno(){
      $a = new Vehiculo_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }
   function eliminar_vehiculo(){
      $a = new Vehiculo_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null,null,null,null,null,null,null,null);
      $res = $a->Eliminar();
      if($res == true) header ("location:../View_Vehiculo?Mensaje=3");
      else header("location:../View_Vehiculo?Mensaje=9");
   }

   function Consultar_E(){
      $a = new Vehiculo_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Vehiculo_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null,null,null,null,null,null,null,null);
      $res = $a->Recuperar();
      if($res) header ("location:../View_Vehiculo_E?Mensaje=4");
      else header("location:../View_Vehiculo_E?Mensaje= 1 ");
   }

   function consultarPorEmpresa(){
      $a = new Vehiculo_m();
      $datos = $a->ConsultPorEmpresa($_GET['id']);
      echo json_encode(["data" => $datos], false);
   }


   function ConsultarPlaca(){
      $a = new Vehiculo_m();
      $datos = $a->ConsultarPlaca($_GET["placa"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   function ConsultarCedula(){
      $a = new Vehiculo_m();
      $datos = $a->ConsultarCedula($_GET["cedula"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }
?>