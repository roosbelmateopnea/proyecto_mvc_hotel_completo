<?php
require_once 'models/User.php';

class ControllerBase {

    public function registerUser($datos){
        $user = new User();

        if($user->validateUser($datos)){
            $_SESSION['errors'] = ['Email ya existe'];
            header('Location: index.php?action=getFormRegisterUser');
            exit;
        }

        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);

        $user->registerUser($datos);

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
            'id' => $usuario['id'],
            'name' => $usuario['name']
        ];

        header('Location: index.php?action=home');
        exit;
    }

    public function getDocumentTypes(){
        return (new User())->getDocumentTypes();
    }
}