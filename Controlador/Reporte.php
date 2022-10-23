<?php

   include("../Modelo/Reporte_m.php");
   //Operaciones de consulta por el metodo get
   if(isset($_GET["operacion"])){
      $consulta = $_GET["operacion"];
      switch($consulta){
         case 'ConsultarTodos':
            consultar_Reporte();
         break;
      }
   }      

   function consultar_Reporte(){
      $a = new Reporte_m();
      $datos = $a->Consultar_Todos();
      /* aqui esta lo que te mencione en la vista, aqui imprimimos con la funcion json_encode, imprimimos un objeto con la propiedad data y dentro de data, esta toda la informacion consultada */
      echo json_encode(["data" => $datos], false);
   }
?>