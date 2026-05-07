<?php
require_once __DIR__ . '/../libraries/fpdf/fpdf.php';
require_once __DIR__ . '/../models/Reserva.php';

class ReportePDF extends FPDF {
    function Header() {
        if (file_exists(__DIR__ . '/../Imagenes/logo Hotel.png')) {
            $this->Image(__DIR__ . '/../Imagenes/logo Hotel.png', 10, 8, 33);
        }
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(13, 110, 253); 
        $this->Cell(0, 10, 'HOTEL LUXURY', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'COMPROBANTE DE RESERVA OFICIAL', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(0, 5, utf8_decode('Ibagué, Tolima - Colombia'), 0, 1, 'C');
        $this->Ln(15); 
        $this->SetDrawColor(13, 110, 253);
        $this->Line(10, 48, 200, 48);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(120, 120, 120);
        $this->Cell(0, 10, utf8_decode('Este documento es un comprobante válido - Página ').$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

function escribirFila($pdf, $label, $valor) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(45, 8, $label, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, $valor, 0, 1);
}

$id_reserva = $_GET['id'] ?? null;
if (!$id_reserva) die("ID no proporcionado.");

$modelo = new Reserva();
$reserva = $modelo->getReservaPorId($id_reserva);
if (!$reserva) die("Reserva no encontrada.");

$pdf = new ReportePDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(230, 230, 230);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 10, utf8_decode(" INFORMACIÓN DEL CLIENTE"), 0, 1, 'L', true);
$pdf->Ln(2);

escribirFila($pdf, "Nombre Completo:", utf8_decode($reserva['cliente_nombre'])); 
escribirFila($pdf, "Correo Electronico:", utf8_decode($reserva['email']));

$pdf->Ln(5);

$pdf->SetFillColor(245, 245, 245);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 10, utf8_decode(" DETALLES DE LA ESTADÍA"), 0, 1, 'L', true);
$pdf->Ln(3);

escribirFila($pdf, "Referencia:", "#" . $reserva['id']);
$habitacionInfo = "Hab. #" . $reserva['num_habitacion'] . " (" . $reserva['tipo_habitacion'] . ")";
escribirFila($pdf, utf8_decode("Habitación:"), utf8_decode($habitacionInfo));
escribirFila($pdf, "Fecha Entrada:", $reserva['fecha_inicio']);
escribirFila($pdf, "Fecha Salida:", $reserva['fecha_final']);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(45, 10, "TOTAL PAGADO:", 0); 
$pdf->SetTextColor(25, 135, 84); 
$pdf->Cell(0, 10, "$" . number_format($reserva['precio'], 0, ',', '.'), 0, 1);

$pdf->Output('I', 'Reserva_' . $id_reserva . '.pdf');