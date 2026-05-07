<?php
if (!isset($_SESSION['data']['id'])) {
    exit("Acceso denegado");
}

require_once __DIR__ . '/../models/Reserva.php';

$id_usuario = $_SESSION['data']['id'];
$modelo = new Reserva();
$reservas = $modelo->getReservasUsuario($id_usuario);

if (ob_get_length()) ob_end_clean();

header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="Reporte_Reservas.xls"');
header('Cache-Control: max-age=0');

echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">';
echo '<head><meta charset="UTF-8"></head><body>';
echo '<table border="1">';

echo '<tr>
    <th style="background-color:#FF6600;color:white;font-weight:bold;">HABITACIÓN</th>
    <th style="background-color:#FF6600;color:white;font-weight:bold;">FECHA INICIO</th>
    <th style="background-color:#FF6600;color:white;font-weight:bold;">FECHA FINAL</th>
    <th style="background-color:#FF6600;color:white;font-weight:bold;">TOTAL</th>
</tr>';

foreach ($reservas as $r) {
    echo '<tr>
        <td>' . htmlspecialchars($r['habitacion']) . '</td>
        <td>' . htmlspecialchars($r['fecha_inicio']) . '</td>
        <td>' . htmlspecialchars($r['fecha_final']) . '</td>
        <td>' . number_format($r['precio'], 0, ',', '.') . '</td>
    </tr>';
}

echo '</table></body></html>';
exit;