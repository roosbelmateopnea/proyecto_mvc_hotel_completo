<?php
session_start();

require_once 'config/config.php';
require_once 'controllers/ControllerBase.php';
require_once 'controllers/ReservaController.php';

$controller = new ControllerBase();
$reservaController = new ReservaController();

$action = $_GET['action'] ?? 'home';

if($action == 'getFormRegisterUser'){
    require_once 'views/auth/register.php';

} elseif($action == 'registerUser'){
    $controller->registerUser($_POST);

} elseif($action == 'getFormLoginUser'){
    require_once 'views/auth/login.php';

} elseif($action == 'loginUser'){ 
    $controller->loginUser($_POST);

} elseif($action == 'closeSession'){
    session_destroy();
    header('Location: index.php?action=home');
    exit;

} elseif($action == 'home'){
    $habitaciones = $reservaController->getHabitaciones();
    $metodosPago = $reservaController->getMetodosPago();
    $categorias = $reservaController->getCategorias();
    $reservas = $reservaController->getReservasUsuario(); 
    require_once 'views/dashboard/reservas.php';

} elseif($action == 'guardarReserva'){
    $reservaController->guardar($_POST);

} elseif($action == 'actualizarReserva'){
    $id = $_GET['id'] ?? 0;
    $reservaController->actualizar($id, $_POST);

} elseif($action == 'eliminarReserva'){
    $id = $_GET['id'] ?? 0;
    $reservaController->eliminar($id);

} elseif($action == 'getRoomsByType'){
    $reservaController->getRoomsByType();

} elseif($action == 'getRoomsByType'){
    $reservaController->getRoomsByType();


} elseif($action == 'descargarComprobante'){
    $reservaController->descargarComprobante();

} else {
    header('Location: index.php?action=home');
}


//club