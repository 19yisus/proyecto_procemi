<?php
   include("../Modelo/Entrada_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_entrada();
         break;

         case 'Actualizar':
            actualizar_entrada();
         break;

         case 'Eliminar':
            eliminar_entrada();
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
            consultar_entradas();
         break;

         case 'ConsultarUno':
            consultar_uno();
         break;

         case 'Consultar_E':
            Consultar_E();
         break;   

         case 'ConsultarModal';
            Consultar_Modal();
         break;


         default:
            echo "No es valida la peticion";
         break;
      }
   }      

   function registrar_entrada(){
      $a = new Entrada_m();
      $a->SetDatos($_POST);
      $res = $a->Registrar();
      if($res) header("location:../View_Entrada?Mensaje=2");
      else header("location:../View_Entrada?Mensaje= 1 ");
   }

   function actualizar_entrada(){
      $a = new Entrada_m();
      $a->SetDatos($_POST);
      $res = $a->Actualizar();
      if($res) header("location:../View_Entrada?Mensaje=2");
      else header("location:../View_Entrada?Mensaje= 1 ");
   }

   function consultar_entradas(){
      $a = new Entrada_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function consultar_uno(){
      $a = new Entrada_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      echo json_encode(["data" => $datos], false);
   }

   function Consultar_Modal(){
      $a = new Entrada_m();
      $datos = $a->consultModal($_GET["id"]);
      echo $datos;
   }

   function eliminar_entrada(){
      $a = new Entrada_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null,null,null,null,null,null,null);
      $res = $a->Eliminar();
      if($res) header ("location:../View_Entrada?Mensaje=3");
      else header("location:../View_Entrada?Mensaje= 1 ");
   }

    /* Eliminados */

    function Consultar_E(){
      $a = new Entrada_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Entrada_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null,null,null,null,null,null,null);
      $res = $a->Recuperar();
      if($res) header ("location:../View_Entradahp?Mensaje=4");
      else header("location:../View_Entradahp?Mensaje= 1 ");
   }

?>