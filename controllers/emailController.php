<?php
require_once 'reportes/MailService.php';

class EmailController {

    public function notificarBienvenida($email, $nombre) {
        $mail = new MailService();
        $mail->enviarBienvenida($email, $nombre);
    }

    public function notificarReserva($email, $data) {
        $nombre = $_SESSION['data']['name'];
        $mail = new MailService();
        $mail->enviarReserva($email, $nombre, $data);
    }
}