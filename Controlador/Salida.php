<?php

   include("../Modelo/Salida_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_salida();
         break;

         case 'Actualizar':
            actualizar_salida();
         break;

         case 'Eliminar':
            eliminar_salida();
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
            consultar_salidas();
         break;

         case 'ConsultarUno':
            consultar_uno();
         break;

         default:
            echo "No es valida la peticion";
         break;
      }
   }      

   function registrar_salida(){
      $a = new Salida_m();
      $a->SetDatos($_POST["ID"],$_POST["Peso"],$_POST["Cantidad"],$_POST["Silo"]);
      $res = $a->Registrar();
      if($res) header("location:../View_Salida?Mensaje=2");
      else header("location:../View_Salida?Mensaje=1 ");
   }

   function consultar_salidas(){
      $a = new Salida_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function consultar_uno(){
      $a = new Salida_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   function eliminar_laboratorio(){
      $a = new Laboratorio_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null,null);
      $res = $a->Eliminar();
      if($res) header ("location:../Vista/laboratorio.php?Mensaje=3");
      else header("location:../Vista/laboratorio.php?Mensaje= algun codigo de error que uses ");
   }
?>