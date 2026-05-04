
<?php

require_once 'connection/conexion.php'; 



class User {

    public function validateUser($data){
        $conexion = new Conexion();
        $conexion->conectar();

        $email = $conexion->real_escape_string($data['email']);

        $sql = "SELECT id FROM usuarios WHERE email = '$email'";
        $conexion->query($sql);

        $result = $conexion->getResult();
        $conexion->desconectar();

        return $result->num_rows > 0;
    }

    public function registerUser($data){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "INSERT INTO usuarios 
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

        $email = $conexion->real_escape_string($data['email']);

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
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

        $doc = $conexion->real_escape_string($data['document_number']);

        $sql = "SELECT id FROM usuarios WHERE document_number = '$doc'";
        $conexion->query($sql);

        $result = $conexion->getResult();
        $conexion->desconectar();

        return $result->num_rows > 0;
    }

    public function getDocumentTypes(){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "SELECT * FROM documentos";
        $conexion->query($sql);

        $result = $conexion->getResult();

        $data = [];
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        $conexion->desconectar();
        return $data;
    }
}