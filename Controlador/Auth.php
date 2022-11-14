<?php

include("../Modelo/Auth_m.php");

//Operaciones por metodo post
if (isset($_POST["operacion"])) {
  $operacion = $_POST['operacion'];
  switch ($operacion) {
    case 'Login':
      login_user();
      break;
    case 'Logout':
      logout_user();
      break;

    case 'Registro':
      registrar_user();
      break;

    case 'cambiarStatus':
      changeStatus();
      break;

    case 'Actualizar':
      actualizar_user();
      break;

    case 'Eliminar':
      eliminar_user();
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
if (isset($_GET["operacion"])) {
  $consulta = $_GET["operacion"];
  switch ($consulta) {
    case 'ConsultarTodos':
      consultar_users();
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

function returnVista()
{
  $indice_inicial = strrpos($_SERVER['HTTP_REFERER'], "View_");

  if (strpos($_SERVER['HTTP_REFERER'], "laboratorio") !== false) $len_string = 22;
  else $len_string = 19;

  $indice_final = strrpos($_SERVER['HTTP_REFERER'], "Mensaje");
  return substr($_SERVER['HTTP_REFERER'], $indice_inicial, $len_string);
}
function login_user()
{
  $a = new Auth_m();
  $a->SetDatos($_POST);
  $res = $a->Loguear();

  if ($res !== 5) $vista = returnVista();
  else {
    $vista = "View_index";
    $res = null;
  }
  header("location: ../$vista?Mensaje=$res");
}
function logout_user()
{
  session_start();
  if ($_SESSION['rol_id'] == "L") $vista = "View_Login-laboratorio";
  if ($_SESSION['rol_id'] == "R") $vista = "View_Login-romanero";
  if ($_SESSION['rol_id'] == "A") $vista = "View_Login-laboratorio";
  session_unset();
  session_destroy();
  header("location: ../$vista");
}
function registrar_user()
{
  $a = new Auth_m();
  $a->SetDatos($_POST);
  $res = $a->Registrar();
  if ($res) header("location:../View_usuarios?Mensaje=2");
  else header("location:../View_usuarios?Mensaje= 1 ");
}
function changeStatus()
{
  $a = new Auth_m();
  $a->SetDatos($_POST);
  $res = $a->changeStatus();
  if ($res) header("location:../View_usuarios?Mensaje=2");
  else header("location:../View_usuarios?Mensaje=1 ");
}

function actualizar_user()
{
  $a = new Auth_m();
  $a->SetDatos($_POST);
  $res = $a->Actualizar();
  if ($res) header("location:../View_usuarios?Mensaje=2");
  else header("location:../View_usuarios?Mensaje=1 ");
}

function consultar_users()
{
  $a = new Auth_m();
  $datos = $a->Consultar_Todos();
  /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
  echo json_encode(["data" => $datos], false);
}

function consultar_uno()
{
  $a = new Auth_m();
  $datos = $a->Consultar_Uno($_GET["id"]);
  echo json_encode(["data" => $datos], false);
}

function eliminar_user()
{
  $a = new Auth_m();
  // $a->SetDatos($_POST);
  // $res = $a->Eliminar();
  // if($res) header ("location:../View_Login?Me$2y$12$SQRNIjhWMZKYnzWvcT46g.RBrRrWsLFe1OV4vyqNodNovfQaNZWSe" ["nombre"]=> string(15) "primer romanero" ["rol_user"]=> string(1) "R" ["estatus_user"]=> string(1) "1" ["fecha_user"]=> strinsaje=3");
  // else header("location:../View_Login?Mensaje= 1 ");
}

/* Eliminados */

function Consultar_E()
{
  $a = new Auth_m();
  // $datos = $a->Consultar_E();
  // echo json_encode(["data" => $datos], false);
}

function Recuperar()
{
  $a = new Auth_m();
  // $a->SetDatos($_POST["ID"],null);
  // $res = $a->Recuperar();
  // if($res) header ("location:../View_Login_E?Mensaje=4");
  // else header("location:../View_Login_E?Mensaje=1 ");
}
