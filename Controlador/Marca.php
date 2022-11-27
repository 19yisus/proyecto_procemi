<?php

   include("../Modelo/Marca_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_marca();
         break;

         case 'Actualizar':
            actualizar_marca();
         break;

         case 'Eliminar':
            eliminar_marca();
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
            consultar_marcas();
         break;

         case 'ConsultarUno':
            consultar_uno();
         break;

         case 'Consultar_E':
            Consultar_E();
         break;   

         case 'ConsultarMarca':
            consultarMarca();
         break;

         default:
            echo "No es valida la peticion";
         break;
      }
   }      

   function registrar_marca(){
      $a = new Marca_m();
      $a->SetDatos(null,$_POST["Nombre"]);
      $res = $a->Registrar();
      if($res) header("location: ../View_marca?Mensaje=2");
      else header("location:../View_marca?Mensaje= 1 ");
   }

   function actualizar_marca(){
      $a = new Marca_m();
      $a->SetDatos($_POST["ID"],$_POST["Nombre"]);
      $res = $a->Actualizar();
      if($res == true) header("location:../View_marca?Mensaje=2");
      else header("location:../View_marca?Mensaje=8");
   }

   function consultar_marcas(){
      $a = new Marca_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function consultar_uno(){
      $a = new Marca_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   function eliminar_marca(){
      $a = new Marca_m();
      $a->SetDatos($_POST["ID"],null);
      $res = $a->Eliminar();
      if($res == true) header ("location:../View_marca?Mensaje=3");
      else header("location:../View_marca?Mensaje=9");
   }

   function consultarMarca(){
      $a = new Marca_m();
      $datos = $a->ConsultarMarca($_GET["nombre"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

    /* Eliminados */

    function Consultar_E(){
      $a = new Marca_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Marca_m();
      $a->SetDatos($_POST["ID"],null);
      $res = $a->Recuperar();
      if($res) header ("location:../View_Marca_E?Mensaje=4");
      else header("location:../View_Marca_E?Mensaje= 1 ");
   }
?>