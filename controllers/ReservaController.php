<?php
require_once 'models/Reserva.php';
require_once 'Lib/Fpdf/fpdf.php';

class ReportePDF extends FPDF {
    function Header() {

        if (file_exists('Imagenes/logo Hotel.png')) {
            $this->Image('Imagenes/logo Hotel.png', 10, 8, 33);
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

class ReservaController {

    public function getHabitaciones(){
        return (new Reserva())->getHabitaciones();
    }

    public function getMetodosPago(){
        return (new Reserva())->getMetodosPago();
    }

    public function getCategorias(){
        return (new Reserva())->getCategorias();
    }

    public function getReservasUsuario(){
        if(!isset($_SESSION['data'])) return [];
        return (new Reserva())->getReservasUsuario($_SESSION['data']['id']);
    }

    public function guardar($data){
        $data['id_usuario'] = $_SESSION['data']['id'];
        (new Reserva())->guardarReserva($data);

        $_SESSION['success'] = "¡Reserva Creada con Éxito!";
        $_SESSION['alert_type'] = "info";
        header('Location: index.php?action=home');
        exit;
    }

    public function eliminar($id){
        (new Reserva())->eliminarReserva($id, $_SESSION['data']['id']);

        $_SESSION['success'] = "Reserva Eliminada Correctamente";
        $_SESSION['alert_type'] = "danger"; 
        header('Location: index.php?action=home');
        exit;
    }

    public function actualizar($id, $data){
        $id_usuario = $_SESSION['data']['id'];
        (new Reserva())->actualizarReserva($id, $data, $id_usuario); 

        $_SESSION['success'] = "Reserva Actualizada con Éxito";
        $_SESSION['alert_type'] = "warning"; 
        header('Location: index.php?action=home');
        exit;
    }

    public function getRoomsByType(){
        header('Content-Type: application/json');
        $tipo = $_GET['type_room_id'] ?? 0;
        $data = (new Reserva())->getRoomsByType($tipo);
        echo json_encode(['ok' => true, 'data' => $data]);
        exit;
    }

    public function descargarComprobante() {
        $id_reserva = $_GET['id'] ?? null;
        if (!$id_reserva) die("Error: ID no proporcionado.");

        $modelo = new Reserva();
        $reserva = $modelo->getReservaPorId($id_reserva); 

        if (!$reserva) die("Error: No se encontraron los datos de la reserva.");

        $pdf = new ReportePDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, utf8_decode(" INFORMACIÓN DEL CLIENTE"), 0, 1, 'L', true);
        $pdf->Ln(2);

        $this->escribirFila($pdf, "Nombre Completo:", utf8_decode($reserva['cliente_nombre'])); 
        $this->escribirFila($pdf, "Correo Electronico:", utf8_decode($reserva['email']));
        $pdf->Ln(5);

        $pdf->SetFillColor(245, 245, 245);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, utf8_decode(" DETALLES DE LA ESTADÍA"), 0, 1, 'L', true);
        $pdf->Ln(3);

        $this->escribirFila($pdf, "Referencia:", "#" . $reserva['id']);
        $habitacionInfo = "Hab. #" . $reserva['num_habitacion'] . " (" . $reserva['tipo_habitacion'] . ")";
        $this->escribirFila($pdf, utf8_decode("Habitación:"), utf8_decode($habitacionInfo));
        $this->escribirFila($pdf, "Fecha Entrada:", $reserva['fecha_inicio']);
        $this->escribirFila($pdf, "Fecha Salida:", $reserva['fecha_final']);

        $pdf->Ln(10);

    
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(45, 10, "TOTAL PAGADO:", 0); 
        $pdf->SetTextColor(25, 135, 84); 
        $pdf->Cell(0, 10, "$" . number_format($reserva['precio'], 0, ',', '.'), 0, 1);

        if (ob_get_length()) ob_end_clean(); 
        $pdf->Output('I', 'Comprobante_Reserva_' . $id_reserva . '.pdf');
        exit; 
    }








    private function escribirFila($pdf, $label, $valor) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 8, $label, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, $valor, 0, 1);
    }

} 