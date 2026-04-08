<?php

class Conexion {

    private $mySQLI;
    private $result;
    private $filasAfectadas;

    public function conectar(){
        $host = 'localhost';
        $db = 'proyecto_hotel';
        $user = 'root';
        $password = '';

        $this->mySQLI = new mysqli($host, $user, $password, $db);

        if ($this->mySQLI->connect_error) {
            die('Error de conexión a la base de datos');
        }
    }

    public function desconectar(){
        $this->mySQLI->close();
    }

    public function query($sql){
        $this->result = $this->mySQLI->query($sql);
        $this->filasAfectadas = $this->mySQLI->affected_rows;
    }

    public function getResult(){
        return $this->result;
    }

    public function getFilasAfectadas(){
        return $this->filasAfectadas;
    }
}

?>