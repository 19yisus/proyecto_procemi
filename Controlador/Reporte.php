<?php

include("../Modelo/Reporte_m.php");
include("./fpdf/fpdf.php");

//Operaciones de consulta por el metodo get

if (isset($_GET["operacion"])) {
	$consulta = $_GET["operacion"];
	switch ($consulta) {
		case 'ConsultarTodos':
			consultar_Reporte();
			break;
		case 'ConsultarPorSilo':
			consultar_Reporte_porSilo();
			break;

		case 'ConsultarPorRechazo':
			consultar_Reporte_ProductosRechazados();
			break;
	}
}

function consultar_Reporte()
{
	$a = new Reporte_m();
	$datos = $a->Consultar_Todos($_GET['desde'], $_GET['hasta']);

	// var_dump($datos[0]['cambios'][1]);
	// die("FFF");
	$pdf = new FPDF("L", 'mm', 'legal');
	$pdf->AddPage();
	$pdf->SetFont("Arial", "B", 10);
	$pdf->Cell(335, 7, "MAIZ MIRIAM SALAZAR, ALMACENAMIENTO EN SILOS PROCEMI COSECHA INVIERNO 2021", 1, 0, "C");
	$pdf->Ln();
	$pdf->SetFont("Arial", "B", 6);
	$pdf->Cell(22, 7, "Fecha", 1, 0, "C");
	$pdf->Cell(15, 7, "Chofer", 1, 0, "C");
	$pdf->Cell(13, 7, "Cedula", 1, 0, "C");
	$pdf->Cell(11, 7, "Placa", 1, 0, "C");
	$pdf->Cell(20, 7, "KG Brutos", 1, 0, "C");
	$pdf->Cell(15, 7, "Tara", 1, 0, "C");
	$pdf->Cell(15, 7, "KG Netos", 1, 0, "C");
	$pdf->Cell(15, 7, "Humedad", 1, 0, "C");
	$pdf->Cell(15, 7, "Impurezas", 1, 0, "C");
	$pdf->Cell(18, 7, "Granos Danados", 1, 0, "C");
	$pdf->Cell(18, 7, "Granos Partidos", 1, 0, "C");
	$pdf->Cell(23, 7, "KG Desc Humedad", 1, 0, "C");
	$pdf->Cell(23, 7, "KG Desc Impurezas", 1, 0, "C");
	// $pdf->Cell(27, 7, "KG descontados", 1, 0, "C");
	$pdf->Cell(24, 7, "Peso Acondisionado", 1, 0, "C");
	$pdf->Cell(35, 7, "Romanero a cargo de la entrada", 1, 0, "C");
	$pdf->Cell(35, 7, "Laboratorio a cargo de la revision", 1, 0, "C");
	$pdf->Cell(18, 7, "Fecha salida", 1, 1, "C");
	// $pdf->Cell(35, 7, "Laboratorio a cargo de la revisión", 1, 1, "C");
	$sumaNeto = 0;
	$sumaAcon = 0;

	foreach ($datos as $item) {
		$pdf->Cell(22, 7, $item['mov']['m_Fecha'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['personal_Nombre'], 1, 0, "C");
		$pdf->Cell(13, 7, $item['mov']['personal_Nacionalidad'] . "-" . $item['mov']['personal_Cedula'], 1, 0, "C");
		$pdf->Cell(11, 7, $item['mov']['vehiculo_Placa'], 1, 0, "C");
		$pdf->Cell(20, 7, $item['mov']['m_Cantidad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_pesoFinal'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_PesoNeto'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_Humedad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_Impureza'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['mov']['m_Dano'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['mov']['m_Partido'], 1, 0, "C");
		$pdf->Cell(23, 7, $item['mov']['m_Desc_Humedad'], 1, 0, "C");
		$pdf->Cell(23, 7, $item['mov']['m_Desc_Impureza'], 1, 0, "C");
		// $pdf->Cell(27, 7, $item['mov']['m_TotalDesc'], 1, 0, "C");
		$pdf->Cell(24, 7, $item['mov']['m_PesoAcon'], 1, 0, "C");
		$pdf->Cell(17, 7, $item['cambios'][0]['Nacionalidad'] . "" . $item['cambios'][0]['cedula_user'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][0]['fecha'], 1, 0, "C");
		$pdf->Cell(17, 7, $item['cambios'][0]['Nacionalidad'] . "" . $item['cambios'][1]['cedula_user'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][1]['fecha'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][2]['fecha'], 1, 0, "C");
		// $pdf->Cell(35, 7, $item['cambios'][1]['cedula_user'], 1, 0, "C");
		$sumaNeto = $item['mov']["m_PesoNeto"] + $sumaNeto;
		$sumaAcon = $item['mov']["m_PesoAcon"] + $sumaAcon;
		/*
		$pdf->Cell(27, 7, "", 1, 0, "C");
		$pdf->Cell(28, 7, "", 1, 1, "C");
		*/
		$pdf->Ln();
	}
	$pdf->SetFont("Arial", "B", 8);
	$pdf->Cell(335, 7, "Datos Generales....                                                                           
	                 "          .                            $sumaNeto   .
		"                                                       
												                          
												                     
												               " . $sumaAcon, 1, 0,);

	$pdf->Output("", "index.pdf", true);
	// var_dump($datos);
}

function consultar_Reporte_porSilo()
{
	$a = new Reporte_m();
	$datos = $a->Consultar_PorEstatus("R");
	$pdf = new FPDF("L", 'mm', 'legal');
	$pdf->AddPage();
	$pdf->SetFont("Arial", "B", 10);
	$pdf->Cell(335, 7, "MAIZ MIRIAM SALAZAR, ALMACENAMIENTO EN SILOS PROCEMI COSECHA INVIERNO 2021", 1, 0, "C");
	$pdf->Ln();
	$pdf->SetFont("Arial", "B", 6);
	$pdf->Cell(22, 7, "Fecha", 1, 0, "C");
	$pdf->Cell(15, 7, "Chofer", 1, 0, "C");
	$pdf->Cell(13, 7, "Cedula", 1, 0, "C");
	$pdf->Cell(11, 7, "Placa", 1, 0, "C");
	$pdf->Cell(20, 7, "KG Brutos", 1, 0, "C");
	$pdf->Cell(15, 7, "Tara", 1, 0, "C");
	$pdf->Cell(15, 7, "KG Netos", 1, 0, "C");
	$pdf->Cell(15, 7, "Humedad", 1, 0, "C");
	$pdf->Cell(15, 7, "Impurezas", 1, 0, "C");
	$pdf->Cell(18, 7, "Granos Danados", 1, 0, "C");
	$pdf->Cell(18, 7, "Granos Partidos", 1, 0, "C");
	$pdf->Cell(23, 7, "KG Desc Humedad", 1, 0, "C");
	$pdf->Cell(23, 7, "KG Desc Impurezas", 1, 0, "C");
	// $pdf->Cell(27, 7, "KG descontados", 1, 0, "C");
	$pdf->Cell(24, 7, "Peso Acondisionado", 1, 0, "C");
	$pdf->Cell(35, 7, "Romanero a cargo de la entrada", 1, 0, "C");
	$pdf->Cell(35, 7, "Laboratorio a cargo de la revision", 1, 0, "C");
	$pdf->Cell(18, 7, "Fecha salida", 1, 1, "C");
	// $pdf->Cell(35, 7, "Laboratorio a cargo de la revisión", 1, 1, "C");
	$sumaNeto = 0;
	$sumaAcon = 0;

	foreach ($datos as $item) {
		$pdf->Cell(22, 7, $item['mov']['m_Fecha'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['personal_Nombre'], 1, 0, "C");
		$pdf->Cell(13, 7, $item['mov']['personal_Nacionalidad'] . "-" . $item['mov']['personal_Cedula'], 1, 0, "C");
		$pdf->Cell(11, 7, $item['mov']['vehiculo_Placa'], 1, 0, "C");
		$pdf->Cell(20, 7, $item['mov']['m_Cantidad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_pesoFinal'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_PesoNeto'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_Humedad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_Impureza'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['mov']['m_Dano'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['mov']['m_Partido'], 1, 0, "C");
		$pdf->Cell(23, 7, $item['mov']['m_Desc_Humedad'], 1, 0, "C");
		$pdf->Cell(23, 7, $item['mov']['m_Desc_Impureza'], 1, 0, "C");
		// $pdf->Cell(27, 7, $item['mov']['m_TotalDesc'], 1, 0, "C");
		$pdf->Cell(24, 7, $item['mov']['m_PesoAcon'], 1, 0, "C");
		$pdf->Cell(17, 7, $item['cambios'][0]['Nacionalidad'] . "" . $item['cambios'][0]['cedula_user'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][0]['fecha'], 1, 0, "C");
		$pdf->Cell(17, 7, $item['cambios'][0]['Nacionalidad'] . "" . $item['cambios'][1]['cedula_user'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][1]['fecha'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][2]['fecha'], 1, 0, "C");
		// $pdf->Cell(35, 7, $item['cambios'][1]['cedula_user'], 1, 0, "C");
		$sumaNeto = $item['mov']["m_PesoNeto"] + $sumaNeto;
		$sumaAcon = $item['mov']["m_PesoAcon"] + $sumaAcon;
		/*
		$pdf->Cell(27, 7, "", 1, 0, "C");
		$pdf->Cell(28, 7, "", 1, 1, "C");
		*/
		$pdf->Ln();
	}
	$pdf->SetFont("Arial", "B", 8);
	$pdf->Cell(335, 7, "Datos Generales....                                                                           
	                 "          .                            $sumaNeto   .
		"                                                       
												                          
												                     
												               " . $sumaAcon, 1, 0,);

	$pdf->Output("", "index.pdf", true);
}

function consultar_Reporte_ProductosRechazados()
{
	$silo = $_GET['silo'];

	$a = new Reporte_m();
	$datos = $a->Consultar_PorSilo($silo,$_GET['desde'], $_GET['hasta']);
	$pdf = new FPDF("L", 'mm', 'legal');
	$pdf->AddPage();
	$pdf->SetFont("Arial", "B", 10);
	$pdf->Cell(335, 7, "MAIZ MIRIAM SALAZAR, ALMACENAMIENTO EN SILOS PROCEMI COSECHA INVIERNO 2021", 1, 0, "C");
	$pdf->Ln();
	$pdf->SetFont("Arial", "B", 6);
	$pdf->Cell(22, 7, "Fecha", 1, 0, "C");
	$pdf->Cell(15, 7, "Chofer", 1, 0, "C");
	$pdf->Cell(13, 7, "Cedula", 1, 0, "C");
	$pdf->Cell(11, 7, "Placa", 1, 0, "C");
	$pdf->Cell(20, 7, "KG Brutos", 1, 0, "C");
	$pdf->Cell(15, 7, "Tara", 1, 0, "C");
	$pdf->Cell(15, 7, "KG Netos", 1, 0, "C");
	$pdf->Cell(15, 7, "Humedad", 1, 0, "C");
	$pdf->Cell(15, 7, "Impurezas", 1, 0, "C");
	$pdf->Cell(18, 7, "Granos Danados", 1, 0, "C");
	$pdf->Cell(18, 7, "Granos Partidos", 1, 0, "C");
	$pdf->Cell(23, 7, "KG Desc Humedad", 1, 0, "C");
	$pdf->Cell(23, 7, "KG Desc Impurezas", 1, 0, "C");
	// $pdf->Cell(27, 7, "KG descontados", 1, 0, "C");
	$pdf->Cell(24, 7, "Peso Acondisionado", 1, 0, "C");
	$pdf->Cell(35, 7, "Romanero a cargo de la entrada", 1, 0, "C");
	$pdf->Cell(35, 7, "Laboratorio a cargo de la revision", 1, 0, "C");
	$pdf->Cell(18, 7, "Fecha salida", 1, 1, "C");
	// $pdf->Cell(35, 7, "Laboratorio a cargo de la revisión", 1, 1, "C");
	$sumaNeto = 0;
	$sumaAcon = 0;

	foreach ($datos as $item) {
		$pdf->Cell(22, 7, $item['mov']['m_Fecha'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['personal_Nombre'], 1, 0, "C");
		$pdf->Cell(13, 7, $item['mov']['personal_Nacionalidad'] . "-" . $item['mov']['personal_Cedula'], 1, 0, "C");
		$pdf->Cell(11, 7, $item['mov']['vehiculo_Placa'], 1, 0, "C");
		$pdf->Cell(20, 7, $item['mov']['m_Cantidad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_pesoFinal'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_PesoNeto'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_Humedad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['mov']['m_Impureza'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['mov']['m_Dano'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['mov']['m_Partido'], 1, 0, "C");
		$pdf->Cell(23, 7, $item['mov']['m_Desc_Humedad'], 1, 0, "C");
		$pdf->Cell(23, 7, $item['mov']['m_Desc_Impureza'], 1, 0, "C");
		// $pdf->Cell(27, 7, $item['mov']['m_TotalDesc'], 1, 0, "C");
		$pdf->Cell(24, 7, $item['mov']['m_PesoAcon'], 1, 0, "C");
		$pdf->Cell(17, 7, $item['cambios'][0]['Nacionalidad'] . "" . $item['cambios'][0]['cedula_user'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][0]['fecha'], 1, 0, "C");
		$pdf->Cell(17, 7, $item['cambios'][0]['Nacionalidad'] . "" . $item['cambios'][1]['cedula_user'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][1]['fecha'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['cambios'][2]['fecha'], 1, 0, "C");
		// $pdf->Cell(35, 7, $item['cambios'][1]['cedula_user'], 1, 0, "C");
		$sumaNeto = $item['mov']["m_PesoNeto"] + $sumaNeto;
		$sumaAcon = $item['mov']["m_PesoAcon"] + $sumaAcon;
		/*
		$pdf->Cell(27, 7, "", 1, 0, "C");
		$pdf->Cell(28, 7, "", 1, 1, "C");
		*/
		$pdf->Ln();
	}
	$pdf->SetFont("Arial", "B", 8);
	$pdf->Cell(335, 7, "Datos Generales....                                                                           
	                 "          .                            $sumaNeto   .
		"                                                       
												                          
												                     
												               " . $sumaAcon, 1, 0,);

	$pdf->Output("", "index.pdf", true);
}
