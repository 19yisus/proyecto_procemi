<?php

   include("../Modelo/Cargo_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_cargo();
         break;

         case 'Actualizar':
            actualizar_cargo();
         break;

         case 'Eliminar':
            eliminar_cargo();
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
            consultar_cargos();
         break;

         case 'ConsultarUno':
            consultar_uno();
         break;

         case 'Consultar_E':
            Consultar_E();
         break;   

         case 'ConsultarCargo':
            consultarCargo();
         break;


         default:
            echo "No es valida la peticion";
         break;
      }
   }      

   function registrar_cargo(){
      $a = new Cargo_m();
      $a->SetDatos(null,$_POST["Nombre"]);
      $res = $a->Registrar();
      if($res) header("location: ../View_cargo?Mensaje=2");
      else header("location: ../View_cargo?Mensaje=1 ");
   }

   function actualizar_cargo(){
      $a = new Cargo_m();
      $a->SetDatos($_POST["ID"],$_POST["Nombre"]);
      $res = $a->Actualizar();
      if($res == true) header("location:../View_cargo?Mensaje=2");
      else header("location:../View_cargo?Mensaje=8");
   }

   function consultar_cargos(){
      $a = new Cargo_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function consultar_uno(){
      $a = new Cargo_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   function eliminar_cargo(){
      $a = new Cargo_m();
      $a->SetDatos($_POST["ID"],null);
      $res = $a->Eliminar();
      if($res == true) header ("location:../View_cargo?Mensaje=3");
      else header("location:../View_cargo?Mensaje=9");
   }

   function consultarCargo(){
      $a = new Cargo_m();
      $datos = $a->ConsultarCargo($_GET["nombre"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   /* Eliminados */

   function Consultar_E(){
      $a = new Cargo_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Cargo_m();
      $a->SetDatos($_POST["ID"],null);
      $res = $a->Recuperar();
      if($res) header ("location:../View_Cargo_E?Mensaje=4");
      else header("location:../View_Cargo_E?Mensaje= 1 ");
   }
