<?php

   include("../Modelo/Empresa_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_empresa();
         break;

         case 'Actualizar':
            actualizar_empresa();
         break;

         case 'Eliminar':
            eliminar_empresa();
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
            consultar_empresas();
         break;

         case 'ConsultarUno':
            consultar_uno();
         break;

         case 'Consultar_E':
            Consultar_E();
         break;

         default:
            echo "No es valida la peticion";
         break;
      }
   }      

   function registrar_empresa(){
      $a = new Empresa_m();
      $rif = $_POST['tipoRif']."-".$_POST['cedula_encargado'];
      $telefono_encargado = $_POST["codigo_area"]."-".$_POST["telefono_encargado"];
      $telefono_empresa = $_POST["codigo_area_e"]."-".$_POST["Telefono"];
      $a->SetDatos(null,$_POST["Encargado"],$rif,$telefono_encargado,$_POST["direccion_encargado"],"J-".$_POST["Rif"],$_POST["Nombre"],$_POST["Ubicacion"],$telefono_empresa,$_POST['empresa_condition']);
      $res = $a->Registrar();
      if($res) header("location:../View_Empresa?Mensaje=2");
      else header("location:../View_Empresa?Mensaje= 1 ");
   }

   function actualizar_empresa(){
      $a = new Empresa_m();
      $rif = $_POST['tipoRif']."-".$_POST['cedula_encargado'];
      $telefono_encargado = $_POST["codigo_area"]."-".$_POST["telefono_encargado"];
      $telefono_empresa = $_POST["codigo_area_e"]."-".$_POST["Telefono"];
      $a->SetDatos($_POST["ID"],$_POST["Encargado"],$rif,$telefono_encargado,$_POST["direccion_encargado"],"J-".$_POST["Rif"],$_POST["Nombre"],$_POST["Ubicacion"],$telefono_empresa,null);
      $res = $a->Actualizar();
      if($res) header("location:../View_Empresa?Mensaje=2");
      else header("location:../View_Empresa?Mensaje= 1 ");
   }

   function consultar_empresas(){
      $a = new Empresa_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function consultar_uno(){
      $a = new Empresa_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   function eliminar_empresa(){
      $a = new Empresa_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null);
      $res = $a->Eliminar();
      if($res) header ("location:../View_Empresa?Mensaje=3");
      else header("location:../View_Empresa?Mensaje= 1 ");
   }

    /* Eliminados */

    function Consultar_E(){
      $a = new Empresa_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Empresa_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null);
      $res = $a->Recuperar();
      if($res) header ("location:../View_Empresa_E?Mensaje=4");
      else header("location:../View_Empresa_E?Mensaje= 1 ");
   }
?>