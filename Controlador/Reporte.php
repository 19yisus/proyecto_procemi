<?php

include("../Modelo/Reporte_m.php");
include("./fpdf/fpdf.php");
//Operaciones de consulta por el metodo get
if (isset($_POST["operacion"])) {
	$consulta = $_POST["operacion"];
	switch ($consulta) {
		case 'ConsultarTodos':
			consultar_Reporte();
			break;
	}
}

function consultar_Reporte()
{
	$a = new Reporte_m();
	$datos = $a->Consultar_Todos($_POST['desde'], $_POST['hasta']);
	$pdf = new FPDF();
	$pdf->AddPage("L");
	$pdf->SetFont("Arial", "B", 6);
	$pdf->Cell(273, 7, "MAIZ MIRIAM SALAZAR, ALMACENAMIENTO EN SILOS PROCEMI COSECHA INVIERNO 2021", 1, 0, "C");
	$pdf->Ln();
	$pdf->Cell(15, 7, "Fecha", 1, 0, "C");
	$pdf->Cell(20, 7, "Chofer", 1, 0, "C");
	$pdf->Cell(15, 7, "Cedula", 1, 0, "C");
	$pdf->Cell(15, 7, "Placa", 1, 0, "C");
	$pdf->Cell(20, 7, "KG Brutos", 1, 0, "C");
	$pdf->Cell(15, 7, "KG Netos", 1, 0, "C");
	$pdf->Cell(15, 7, "Humedad", 1, 0, "C");
	$pdf->Cell(15, 7, "Impurezas", 1, 0, "C");
	$pdf->Cell(18, 7, "Granos Danados", 1, 0, "C");
	$pdf->Cell(20, 7, "Granos Partidos", 1, 0, "C");
	$pdf->Cell(25, 7, "KG Desc Por Humedad", 1, 0, "C");
	$pdf->Cell(25, 7, "KG Desc por Impurezas", 1, 0, "C");
	$pdf->Cell(27, 7, "Total de KG descontados", 1, 0, "C");
	$pdf->Cell(28, 7, "Peso Acondisionado al 12%", 1, 1, "C");

	foreach ($datos as $item) {
		$pdf->Cell(15, 7, $item['m_Fecha'], 1, 0, "C");
		$pdf->Cell(20, 7, $item['personal_Nombre'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['personal_Nacionalidad'] . "-" . $item['personal_Cedula'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['vehiculo_Placa'], 1, 0, "C");
		$pdf->Cell(20, 7, $item['m_Cantidad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['m_PesoNeto'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['m_Humedad'], 1, 0, "C");
		$pdf->Cell(15, 7, $item['m_Impureza'], 1, 0, "C");
		$pdf->Cell(18, 7, $item['m_Dano'], 1, 0, "C");
		$pdf->Cell(20, 7, $item['m_Partido'], 1, 0, "C");
		$pdf->Cell(25, 7, $item['m_Desc_Humedad'], 1, 0, "C");
		$pdf->Cell(25, 7, $item['m_Desc_Impureza'], 1, 0, "C");
		$pdf->Cell(27, 7, "", 1, 0, "C");
		$pdf->Cell(28, 7, "", 1, 1, "C");
	}
	

	$pdf->Output("", "index.pdf", true);
	// var_dump($datos);
}
