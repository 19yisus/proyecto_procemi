<?php
   include("../Modelo/Personal_m.php");
   
   //Operaciones por metodo post
   if(isset($_POST["operacion"])){
      $operacion = $_POST['operacion'];
      switch($operacion){
         case 'Registro':
            registrar_personal();
         break;

         case 'Actualizar':
            actualizar_personal();
         break;

         case 'Eliminar':
            eliminar_personal();
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
            consultar_personales();
         break;

         case 'ConsultarUno':
            consultar_uno();
         break;

         case 'ConsultarCedula':
            consultarCedula();
         break;

         case 'Consultar_E':
            Consultar_E();
         break;   

         default:
            echo "No es valida la peticion";
         break;
      }
   }      

   function registrar_personal(){
      $a = new Personal_m();
      $telefono = $_POST["codigo_area"]."-".$_POST["Telefono"];
      $a->SetDatos(null,$_POST["Nombre"],$_POST["Apellido"],$_POST["Nacionalidad"],$_POST["Cedula"],$telefono,$_POST["Correo"],$_POST["Direccion"],$_POST["Empresa"],$_POST["Cargo"]);
      $res = $a->Registrar();
      if($res === 5) header("location:../View_Personal?Mensaje=5");
      if($res) header("location:../View_Personal?Mensaje=2");
      else header("location:../View_Personal?Mensaje= 1 ");
   }

   function actualizar_personal(){
      $a = new Personal_m();
      $a->SetDatos($_POST["ID"],$_POST["Nombre"],$_POST["Apellido"],$_POST["Nacionalidad"],$_POST["Cedula"],$_POST["Telefono"],$_POST["Correo"],$_POST["Direccion"],$_POST["Empresa"],$_POST["Cargo"]);
      $res = $a->Actualizar();
      if($res) header("location:../View_Personal?Mensaje=2");
      else header("location:../View_Personal?Mensaje= 1 ");
   }

   function consultar_personales(){
      $a = new Personal_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }
   function consultar_uno(){
      $a = new Personal_m();
      $datos = $a->Consultar_Uno($_GET["id"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }
   function consultarCedula(){
      $a = new Personal_m();
      $datos = $a->ConsultarCedula($_GET["cedula"]);
      /* La misma explicacion de arriba */
      echo json_encode(["data" => $datos], false);
   }
   function eliminar_personal(){
      $a = new Personal_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null,null,null,null,null);
      $res = $a->Eliminar();
      if($res) header ("location:../View_Personal?Mensaje=3");
      else header("location:../View_Personal?Mensaje= 1 ");
   }

 /* Eliminados */

   function Consultar_E(){
      $a = new Personal_m();
      $datos = $a->Consultar_E();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }

   function Recuperar(){
      $a = new Personal_m();
      $a->SetDatos($_POST["ID"],null,null,null,null,null,null,null,null,null);
      $res = $a->Recuperar();
      if($res) header ("location:../Vista/Personal_E.php?Mensaje=4");
      else header("location:../Vista/Personal_E.php?Mensaje= 1 ");
   }

?>
