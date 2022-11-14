<?php

   include("../Modelo/Modelo_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_modelo();
         break;

         case 'Actualizar':
            actualizar_modelo();
         break;

         case 'Eliminar':
            eliminar_modelo();
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
            consultar_modelos();
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

   function registrar_modelo(){
      $a = new Modelo_m();
      $a->SetDatos(null,$_POST["Nombre"],$_POST["Marca"]);
      $res = $a->Registrar();
      if($res === 5) header("location:../View_modelo?Mensaje=2");
      if($res) header("location:../View_modelo?Mensaje=5");
      else header("location:../View_modelo?Mensaje= 1 ");
   }

   function actualizar_modelo(){
      $a = new Modelo_m();
      $a->SetDatos($_POST["ID"],$_POST["Nombre"],$_POST["Marca"]);
      $res = $a->Actualizar();
      if($res) header("location:../View_modelo?Mensaje=2");
      else header("location:../View_modelo?Mensaje= 1 ");
   }

   function consultar_modelos(){
      $a = new Modelo_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function consultar_uno(){
      $a = new Modelo_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   function eliminar_modelo(){
      $a = new Modelo_m();
      $a->SetDatos($_POST["ID"],null,null);
      $res = $a->Eliminar();
      if($res) header ("location:../View_modelo?Mensaje=3");
      else header("location:../View_modelo?Mensaje= 1 ");
   }

   /* Eliminados */

   function Consultar_E(){
      $a = new Modelo_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Modelo_m();
      $a->SetDatos($_POST["ID"],null,null);
      $res = $a->Recuperar();
      if($res) header ("location:../View_Modelo_E?Mensaje=4");
      else header("location:../View_Modelo_E?Mensaje= 1 ");
   }

?>