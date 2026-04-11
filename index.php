<?php
session_start();

require_once 'controllers/controllerBase.php';
require_once 'config/config.php';

$controller = new ControllerBase();

$action = $_GET['action'] ?? 'home';

if($action == 'getFormRegisterUser'){
    $documentTypes = $controller->getDocumentTypes();
    require_once 'auth/register.php';

} elseif($action == 'registerUser'){

    $controller->registerUser($_POST);

} elseif($action == 'getFormLoginUser'){

    $controller->verPaginaInicio('auth/login.php');

} elseif($action == 'loginUser'){ 

    $controller->loginUser($_POST);

} elseif($action == 'home'){

    $controller->verPaginaInicio('views/home.php');

} elseif($action == 'closeSession'){

    session_destroy();
    header('Location: /proyecto_hotel/index.php?action=home');
    exit;

} else {

    $controller->verPaginaInicio('views/home.php');
}