<?php
require_once 'models/Reserva.php';
require_once 'controllers/EmailController.php';

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
        (new EmailController())->notificarReserva($_SESSION['data']['email'], $data);
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
}