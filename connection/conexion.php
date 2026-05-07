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
            die('Error de conexión: ' . $this->mySQLI->connect_error);
        }

        $this->mySQLI->set_charset("utf8");
    }

    public function desconectar(){
        if($this->mySQLI){
            $this->mySQLI->close();
        }
    }

    public function query($sql){
        $this->result = $this->mySQLI->query($sql);
        $this->filasAfectadas = $this->mySQLI->affected_rows;

        if(!$this->result){
            die("Error SQL: " . $this->mySQLI->error);
        }

        return $this->result; 
    }

    public function getResult(){
        return $this->result;
    }

    public function getFilasAfectadas(){
        return $this->filasAfectadas;
    }

    public function real_escape_string($string){
        return $this->mySQLI->real_escape_string($string);
    }

   
    public function getError(){
        return $this->mySQLI->error;
    }
}

?>