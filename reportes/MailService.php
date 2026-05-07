<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../libraries/phpmailer/src/Exception.php';
require_once __DIR__ . '/../libraries/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../libraries/phpmailer/src/SMTP.php';

class MailService {

    private function crearMailer() {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'roosbelmateopena621@gmail.com';
        $mail->Password = 'mqoz kqyf ywbe nrbd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('roosbelmateopena621@gmail.com', 'Hotel Luxury');
        return $mail;
    }

    public function enviarBienvenida($email, $nombre) {
        try {
            $mail = $this->crearMailer();
            $mail->addAddress($email, $nombre);
            $mail->isHTML(true);
            $mail->Subject = '¡Bienvenido a Hotel Luxury, ' . $nombre . '!';
            $mail->Body = '
            <div style="font-family:Georgia,serif;max-width:620px;margin:auto;border:1px solid #ddd;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.1);">
                <div style="background:linear-gradient(135deg,#0a1f44,#1a3a6b);padding:40px 30px;text-align:center;">
                    <h1 style="color:#C9A84C;margin:0;font-size:28px;letter-spacing:3px;">✦ HOTEL LUXURY ✦</h1>
                    <p style="color:#a8c0e0;margin:8px 0 0;font-size:13px;letter-spacing:2px;">EXPERIENCIA EXCLUSIVA</p>
                </div>
                <div style="height:4px;background:linear-gradient(90deg,#C9A84C,#f0d080,#C9A84C);"></div>
                <div style="padding:40px 35px;background:#ffffff;">
                    <h2 style="color:#0a1f44;font-size:22px;margin-top:0;">Estimado/a <span style="color:#C9A84C;">' . $nombre . '</span>,</h2>
                    <p style="color:#444;font-size:15px;line-height:1.8;">
                        Es un placer darle la bienvenida a <strong>Hotel Luxury</strong>. Su cuenta ha sido creada exitosamente y ya puede disfrutar de todos nuestros servicios exclusivos.
                    </p>
                    <div style="background:#f4f7fc;border-left:4px solid #C9A84C;padding:20px 25px;border-radius:6px;margin:25px 0;">
                        <p style="color:#0a1f44;font-weight:bold;margin:0 0 10px;font-size:15px;">Con su cuenta puede:</p>
                        <ul style="color:#555;font-size:14px;line-height:2;margin:0;padding-left:18px;">
                            <li>Reservar habitaciones de lujo</li>
                            <li>Gestionar y consultar sus reservas</li>
                            <li>Descargar comprobantes en PDF</li>
                            <li>Exportar reportes en Excel</li>
                        </ul>
                    </div>
                    <p style="color:#444;font-size:14px;line-height:1.8;">
                        Estamos a su disposición para hacer de su estadía una experiencia inolvidable.
                    </p>
                    <div style="text-align:center;margin-top:35px;">
                        <a href="http://localhost/proyecto_hotel" 
                           style="background:linear-gradient(135deg,#0a1f44,#1a3a6b);color:#C9A84C;padding:14px 40px;border-radius:6px;text-decoration:none;font-size:15px;letter-spacing:1px;border:1px solid #C9A84C;">
                            ACCEDER AL PORTAL
                        </a>
                    </div>
                </div>
                <div style="height:4px;background:linear-gradient(90deg,#C9A84C,#f0d080,#C9A84C);"></div>
                <div style="background:#0a1f44;padding:20px;text-align:center;">
                    <p style="color:#C9A84C;font-size:12px;margin:0;letter-spacing:1px;">© 2026 Hotel Luxury — Todos los derechos reservados</p>
                    <p style="color:#a8c0e0;font-size:11px;margin:5px 0 0;">Este correo es generado automáticamente, por favor no responder.</p>
                </div>
            </div>';
            $mail->send();
        } catch (Exception $e) {
            // Silencioso
        }
    }

    public function enviarReserva($email, $nombre, $reserva) {
        try {
            $mail = $this->crearMailer();
            $mail->addAddress($email, $nombre);
            $mail->isHTML(true);
            $mail->Subject = '✅ Confirmación de Reserva — Hotel Luxury';
            $mail->Body = '
            <div style="font-family:Georgia,serif;max-width:620px;margin:auto;border:1px solid #ddd;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.1);">
                <div style="background:linear-gradient(135deg,#0a1f44,#1a3a6b);padding:40px 30px;text-align:center;">
                    <h1 style="color:#C9A84C;margin:0;font-size:28px;letter-spacing:3px;">✦ HOTEL LUXURY ✦</h1>
                    <p style="color:#a8c0e0;margin:8px 0 0;font-size:13px;letter-spacing:2px;">CONFIRMACIÓN DE RESERVA</p>
                </div>
                <div style="height:4px;background:linear-gradient(90deg,#C9A84C,#f0d080,#C9A84C);"></div>
                <div style="padding:40px 35px;background:#ffffff;">
                    <h2 style="color:#0a1f44;font-size:22px;margin-top:0;">
                        Estimado/a <span style="color:#C9A84C;">' . $nombre . '</span>,
                    </h2>
                    <p style="color:#444;font-size:15px;line-height:1.8;">
                        Su reserva ha sido registrada exitosamente. A continuación encontrará el resumen de su estadía.
                    </p>
                    <div style="background:#f4f7fc;border-left:4px solid #C9A84C;padding:25px;border-radius:6px;margin:25px 0;">
                        <p style="color:#0a1f44;font-weight:bold;margin:0 0 15px;font-size:16px;letter-spacing:1px;">📋 DETALLES DE SU RESERVA</p>
                        <table style="width:100%;border-collapse:collapse;">
                            <tr style="border-bottom:1px solid #dde3ee;">
                                <td style="padding:12px 5px;color:#0a1f44;font-weight:bold;font-size:14px;">🛏️ Habitación</td>
                                <td style="padding:12px 5px;color:#555;font-size:14px;">' . $reserva['id_habitacion'] . '</td>
                            </tr>
                            <tr style="border-bottom:1px solid #dde3ee;">
                                <td style="padding:12px 5px;color:#0a1f44;font-weight:bold;font-size:14px;">📅 Fecha Inicio</td>
                                <td style="padding:12px 5px;color:#555;font-size:14px;">' . $reserva['fecha_inicio'] . '</td>
                            </tr>
                            <tr style="border-bottom:1px solid #dde3ee;">
                                <td style="padding:12px 5px;color:#0a1f44;font-weight:bold;font-size:14px;">📅 Fecha Final</td>
                                <td style="padding:12px 5px;color:#555;font-size:14px;">' . $reserva['fecha_final'] . '</td>
                            </tr>
                            <tr style="border-bottom:1px solid #dde3ee;">
                                <td style="padding:12px 5px;color:#0a1f44;font-weight:bold;font-size:14px;">👥 Personas</td>
                                <td style="padding:12px 5px;color:#555;font-size:14px;">' . $reserva['num_personas'] . '</td>
                            </tr>
                            <tr>
                                <td style="padding:12px 5px;color:#0a1f44;font-weight:bold;font-size:14px;">💰 Total</td>
                                <td style="padding:12px 5px;color:#C9A84C;font-size:16px;font-weight:bold;">$' . number_format($reserva['precio'], 0, ',', '.') . '</td>
                            </tr>
                        </table>
                    </div>
                    <p style="color:#444;font-size:14px;line-height:1.8;">
                        Gracias por elegirnos. Nuestro equipo estará listo para recibirle y garantizar una estadía excepcional.
                    </p>
                    <div style="text-align:center;margin-top:35px;">
                        <a href="http://localhost/proyecto_hotel" 
                           style="background:linear-gradient(135deg,#0a1f44,#1a3a6b);color:#C9A84C;padding:14px 40px;border-radius:6px;text-decoration:none;font-size:15px;letter-spacing:1px;border:1px solid #C9A84C;">
                            VER MIS RESERVAS
                        </a>
                    </div>
                </div>
                <div style="height:4px;background:linear-gradient(90deg,#C9A84C,#f0d080,#C9A84C);"></div>
                <div style="background:#0a1f44;padding:20px;text-align:center;">
                    <p style="color:#C9A84C;font-size:12px;margin:0;letter-spacing:1px;">© 2026 Hotel Luxury — Todos los derechos reservados</p>
                    <p style="color:#a8c0e0;font-size:11px;margin:5px 0 0;">Este correo es generado automáticamente, por favor no responder.</p>
                </div>
            </div>';
            $mail->send();
        } catch (Exception $e) {
            
        }
    }
}