<?php

require_once 'conexion.php';

class User {

    public function validateUser($data){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "SELECT * FROM users WHERE email = '{$data['email']}'";
        $conexion->query($sql);

        $result = $conexion->getResult();
        $conexion->desconectar();

        if($result->num_rows > 0){
            return 1;
        }

        return 0;
    }

    public function registerUser($data){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "INSERT INTO users 
        (document_type_id, document_number, name, last_name, phone, email, password, role_id) 
        VALUES 
        (
            '{$data['document_type_id']}',
            '{$data['document_number']}',
            '{$data['name']}',
            '{$data['last_name']}',
            '{$data['phone']}',
            '{$data['email']}',
            '{$data['password']}',
            '1'
        )";

        $conexion->query($sql);
        $filas = $conexion->getFilasAfectadas();

        $conexion->desconectar();

        return $filas;
    }


    public function loginUser($data){
        $conexion = new Conexion();
        $conexion->conectar();

        $email = $data['email'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $conexion->query($sql);
        $result = $conexion->getResult();

        $conexion->desconectar();

        if($result->num_rows > 0){
            return $result->fetch_assoc(); 
        }

        return null;
    }

    public function validateDocument($data){
    $conexion = new Conexion();
    $conexion->conectar();

    $document = $data['document_number'];

    $sql = "SELECT * FROM users WHERE document_number = '$document'";
    $conexion->query($sql);

    $result = $conexion->getResult();
    $conexion->desconectar();

    if($result->num_rows > 0){
        return 1;
    }

    return 0;
}

    





}

?>