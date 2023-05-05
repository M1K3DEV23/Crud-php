<?php

require_once "conn.php";
require_once "fpdf/fpdf.php";

$resultado = "SELECT * FROM estudiante ORDER BY id";
$sql = $conn->query($resultado);
$pdf = new FPDF();
$pdf->AddPage("landscape");
$pdf->AliasNbPages();
$pdf->SetFont("Arial", 'B', 12);
$pdf->SetDrawColor(65, 105, 225);

/* TITULO DE LA TABLA */
//color
$pdf->SetTextColor(65, 105, 225);
$pdf->Cell(100); // mover a la derecha
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(100, 10, "REPORTE DE ESTUDIANTES", 0, 1, 'C', 0);
$pdf->Ln(7);

/* CAMPOS DE LA TABLA */
//color
$pdf->SetFillColor(65, 105, 225); //colorFondo
$pdf->SetTextColor(0, 0, 0); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 10, 'NOMBRE', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'APELLIDO', 1, 0, 'C', 1);
$pdf->Cell(25, 10, 'TELEFONO', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'CORREO', 1, 0, 'C', 1);
$pdf->Cell(110, 10, 'DIRECCION', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'FECHA DE ALTA', 1, 1, 'C', 1);

while ($fila = $sql->fetch_object()) {
    $nombre = $fila->nombre;
    $apellidos = $fila->apellidos;
    $numero_contacto = $fila->numero_contacto;
    $correo = $fila->correo;
    $direccion = $fila->direccion;
    $fecha_alta = $fila->fecha_alta;

    $pdf->Cell(30, 10, $nombre, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $apellidos, 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $numero_contacto, 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $correo, 1, 0, 'C', 0);
    $pdf->Cell(110, 10, $direccion, 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $fecha_alta, 1, 1, 'C', 0);
}

$pdf->Output("Reporte.pdf", 'I');
?>