<?php

class PdfController {

    public function descargarComprobante() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Error: ID de reserva no proporcionado.");
        header("Location: reportes/index.php?id=$id");
        exit;
    }
}