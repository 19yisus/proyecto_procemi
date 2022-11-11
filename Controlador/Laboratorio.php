<?php

include("../Modelo/Laboratorio_m.php");

//Operaciones por metodo post
if (isset($_POST["operacion"])) {
   $operacion = $_POST['operacion'];
   switch ($operacion) {
      case 'Registro':
         registrar_laboratorio();
         break;

      case 'Rechazo':
         rechazo();
         break;

      case 'Eliminar':
         eliminar_laboratorio();
         break;

      default:
         echo "No es valida la peticion";
         break;
   }
}
//Operaciones de consulta por el metodo get
if (isset($_GET["operacion"])) {
   $consulta = $_GET["operacion"];
   switch ($consulta) {
      case 'ConsultarTodos':
         consultar_laboratorios();
         break;

      case 'ConsultarUno':
         consultar_uno();
         break;

      default:
         echo "No es valida la peticion";
         break;
   }
}

function registrar_laboratorio()
{
   $a = new Laboratorio_m();

   if (!isset($_POST['Impureza'])) {
      $a->SetDatos($_POST["ID"], $_POST["Muestra"],null,null,null,null,null,null);
      $res = $a->Registrar();
      if ($res) header("location:../View_Laboratorio?Mensaje=2");
      else header("location:../View_Laboratorio?Mensaje=1 ");
   } else {
      $a->SetDatos($_POST["ID"], $_POST["Muestra"], $_POST["Dano"], $_POST["Partido"], $_POST["Humedad"], $_POST["Impureza"], $_POST["Cantidad"], $_POST['estatus_ope']);
      $res = $a->Registrar();
      if ($res) header("location:../View_Laboratorio?Mensaje=2");
      else header("location:../View_Laboratorio?Mensaje=1 ");
   }
}

function rechazo()
{
   $a = new Laboratorio_m();
   $res = $a->Rechazo($_POST['ID'],$_POST['observacion']);
   if ($res) header("location:../View_Laboratorio?Mensaje=2");
   else header("location:../View_Laboratorio?Mensaje=1 ");
}

// function actualizar_laboratorio(){
//    $a = new Laboratorio_m();
//    $a->SetDatos($_POST["ID"],$_POST["Muestra"],$_POST["Dano"],$humedad,$_POST["Impureza"], null);
//    $res = $a->Actualizar();
//    if($res) header("location:../Vista/laboratorio.php?Mensaje=2");
//    else header("location:../Vista/laboratorio.php?Mensaje= algun codigo de error que uses ");
// }

function consultar_laboratorios()
{
   $a = new Laboratorio_m();
   $datos = $a->Consultar_Todos();
   /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
   echo json_encode(["data" => $datos], false);
}

function consultar_uno()
{
   $a = new Laboratorio_m();
   $datos = $a->Consultar_Uno($_GET["id"]);
   /* La misma explicacion de arriba */
   echo json_encode(["data" => $datos], false);
}

function eliminar_laboratorio()
{
   $a = new Laboratorio_m();
   $a->SetDatos($_POST["ID"], null, null, null, null, null, null);
   $res = $a->Eliminar();
   if ($res) header("location:../Vista/laboratorio.php?Mensaje=3");
   else header("location:../Vista/laboratorio.php?Mensaje= algun codigo de error que uses ");
}
