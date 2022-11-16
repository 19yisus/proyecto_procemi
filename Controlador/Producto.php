<?php

   include("../Modelo/Producto_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_producto();
         break;

         case 'Actualizar':
            actualizar_producto();
         break;

         case 'Eliminar':
            eliminar_producto();
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
            consultar_productos();
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

   function registrar_producto(){
      $a = new Producto_m();
      $a->SetDatos(null,$_POST["Nombre"]);
      $res = $a->Registrar();
      if($res === 5) header("location:../View_Producto?Mensaje=5");
      if($res) header("location: ../View_Producto?Mensaje=2");
      else header("location:../View_Producto?Mensaje=1 ");
   }

   function actualizar_producto(){
      $a = new Producto_m();
      $a->SetDatos($_POST["ID"],$_POST["Nombre"]);
      $res = $a->Actualizar();
      if($res) header("location:../View_Producto?Mensaje=2");
      else header("location:../View_Producto?Mensaje=1 ");
   }

   function consultar_productos(){
      $a = new Producto_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function consultar_uno(){
      $a = new Producto_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }

   function eliminar_producto(){
      $a = new Producto_m();
      $a->SetDatos($_POST["ID"],null);
      $res = $a->Eliminar();
      if($res) header ("location:../View_Producto?Mensaje=3");
      else header("location:../View_Producto?Mensaje=1 ");
   }

    /* Eliminados */

    function Consultar_E(){
      $a = new Producto_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Producto_m();
      $a->SetDatos($_POST["ID"],null);
      $res = $a->Recuperar();
      if($res) header ("location:../View_Producto_E?Mensaje=4");
      else header("location:../View_Producto_E?Mensaje= 1 ");
   }
?>