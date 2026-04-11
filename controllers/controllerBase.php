<?php
require_once 'models/user.php';
require_once 'config/config.php';

class ControllerBase {
    public function verPaginaInicio($vista){
        if(file_exists($vista)){
            require_once $vista;
        } else {
            echo "Vista no encontrada en la ruta especificada";
        }
    }

    public function registerUser($datos){
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        unset($_SESSION['success']);

        $errores = $this->validateData($datos);

        if(count($errores) > 0){
            $_SESSION['errors'] = $errores;
            $_SESSION['old'] = $datos;
            header('Location: ' . SITE_URL . 'index.php?action=getFormRegisterUser');
            exit;
        }

        $user = new User();
        $existeEmail = $user->validateUser($datos);
        $existeDocumento = $user->validateDocument($datos);

        if($existeEmail > 0){
            $_SESSION['errors'] = ['general' => 'El email ya está registrado'];
            $_SESSION['old'] = $datos;
            header('Location: ' . SITE_URL . 'index.php?action=getFormRegisterUser');
            exit;
        }

        if($existeDocumento > 0){
            $_SESSION['errors'] = ['general' => 'El número de documento ya está registrado'];
            $_SESSION['old'] = $datos;
            header('Location: ' . SITE_URL . 'index.php?action=getFormRegisterUser');
            exit;
        }

        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        $resultado = $user->registerUser($datos);

        if($resultado > 0){
            $_SESSION['success'] = 'Usuario registrado exitosamente';
            header('Location: ' . SITE_URL . 'index.php?action=getFormLoginUser');
            exit;
        } else {
            $_SESSION['errors'] = ['general' => 'Error al registrar el usuario'];
            header('Location: ' . SITE_URL . 'index.php?action=getFormRegisterUser');
            exit;
        }
    }

    public function validateData($datos){
        $errores = [];
        if(empty(trim($datos['document_type_id'] ?? ''))){ $errores['document_type_id'] = 'Tipo de documento requerido'; }
        if(empty(trim($datos['document_number'] ?? ''))){ 
            $errores['document_number'] = 'Número requerido'; 
        } elseif(!preg_match('/^[0-9]+$/', $datos['document_number'])){
            $errores['document_number'] = 'Solo se permiten números';
        }
        if(empty(trim($datos['name'] ?? ''))){ $errores['name'] = 'Nombre requerido'; }
        if(empty(trim($datos['last_name'] ?? ''))){ $errores['last_name'] = 'Apellido requerido'; }
        if(empty(trim($datos['phone'] ?? ''))){ $errores['phone'] = 'Teléfono requerido'; }
        if(empty(trim($datos['email'] ?? ''))){ 
            $errores['email'] = 'Email requerido'; 
        } elseif(!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)){
            $errores['email'] = 'Email no válido';
        }
        if(empty($datos['password'] ?? '')){ 
            $errores['password'] = 'Contraseña requerida'; 
        } elseif(strlen($datos['password']) < 6){
            $errores['password'] = 'Mínimo 6 caracteres';
        } elseif(!preg_match('/[A-Z]/', $datos['password']) || !preg_match('/[a-z]/', $datos['password']) || !preg_match('/[0-9]/', $datos['password']) || !preg_match('/[\W]/', $datos['password'])){
            $errores['password'] = 'Debe tener mayúscula, minúscula, número y símbolo';
        }
        if(empty($datos['confirmar_password'] ?? '')){ 
            $errores['confirmar_password'] = 'Confirmar contraseña'; 
        } elseif($datos['password'] != $datos['confirmar_password']){
            $errores['confirmar_password'] = 'No coinciden';
        }
        return $errores;
    }

    public function loginUser($data){
        $errors = [];
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if($email == ''){ $errors['email'] = 'El email es requerido'; }
        if($password == ''){ $errors['password'] = 'La contraseña es requerida'; }

        if(count($errors) > 0){
            $_SESSION['errors'] = $errors;
            header('Location: ' . SITE_URL . 'index.php?action=getFormLoginUser');
            exit;
        }

        $user = new User();
        $usuario = $user->loginUser($data);

        if(!$usuario){
            $_SESSION['errors']['email'] = 'Usuario no existe';
            header('Location: ' . SITE_URL . 'index.php?action=getFormLoginUser');
            exit;
        }

        if(!password_verify($password, $usuario['password'])){
            $_SESSION['errors']['password'] = 'Contraseña incorrecta';
            header('Location: ' . SITE_URL . 'index.php?action=getFormLoginUser');
            exit;
        }

        $_SESSION['data'] = [
            'id' => $usuario['id'],
            'name' => $usuario['name'],
            'email' => $usuario['email']
        ];

        header('Location: ' . SITE_URL . 'index.php?action=home');
        exit;
    }

    public function getDocumentTypes(){
        $conexion = new Conexion();
        $conexion->conectar();
        $sql = "SELECT * FROM documentos";
        $conexion->query($sql);
        $result = $conexion->getResult();
        $conexion->desconectar();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>