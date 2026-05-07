<?php
require_once 'models/User.php';
require_once 'controllers/EmailController.php';

class ControllerBase {

    public function getFormRegisterUser() {
        $userModel = new User();
        $documentTypes = $userModel->getDocumentTypes(); 
        require_once 'views/auth/register.php'; 
    }

    public function registerUser($datos){
        $user = new User();
        if($user->validateUser($datos)){
            $_SESSION['errors'] = ['Email ya existe'];
            header('Location: index.php?action=getFormRegisterUser');
            exit;
        }
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        $user->registerUser($datos);
        (new EmailController())->notificarBienvenida($datos['email'], $datos['name']);
        $_SESSION['success'] = 'Usuario registrado';
        header('Location: index.php?action=getFormLoginUser');
        exit;
    }

    public function loginUser($data){
        $user = new User();
        $usuario = $user->loginUser($data);
        if(!$usuario || !password_verify($data['password'], $usuario['password'])){
            $_SESSION['errors'] = ['Credenciales incorrectas'];
            header('Location: index.php?action=getFormLoginUser');
            exit;
        }
        $_SESSION['data'] = [
            'id'    => $usuario['id'],
            'name'  => $usuario['name'],
            'email' => $usuario['email']
        ];
        header('Location: index.php?action=home');
        exit;
    }
}