
<?php

require_once 'connection/conexion.php'; 


class Reserva {

    public function getHabitaciones(){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "SELECT * FROM habitaciones WHERE estado='disponible'";
        $conexion->query($sql);

        $result = $conexion->getResult();
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function getCategorias(){
        $conexion = new Conexion();
        $conexion->conectar();

        $conexion->query("SELECT * FROM categorias");

        $result = $conexion->getResult();
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function getMetodosPago(){
        $conexion = new Conexion();
        $conexion->conectar();

        $conexion->query("SELECT * FROM metodos_pago");

        $result = $conexion->getResult();
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function getReservasUsuario($id){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "SELECT r.*, h.num_habitacion, c.nombre as habitacion
                FROM reservas r
                JOIN habitaciones h ON r.id_habitacion = h.id
                JOIN categorias c ON h.id_categoria = c.id
                WHERE r.id_usuario='$id' AND r.estado='activa'";

        $conexion->query($sql);

        $result = $conexion->getResult();
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function guardarReserva($data){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "INSERT INTO reservas 
        (id_usuario, id_habitacion, fecha_inicio, fecha_final, num_personas, precio, id_metodo_pago, estado)
        VALUES (
            '{$data['id_usuario']}',
            '{$data['id_habitacion']}',
            '{$data['fecha_inicio']}',
            '{$data['fecha_final']}',
            '{$data['num_personas']}',
            '{$data['precio']}',
            '{$data['id_metodo_pago']}',
            'activa'
        )";

        $conexion->query($sql);
    }

    public function eliminarReserva($id, $user){
        $conexion = new Conexion();
        $conexion->conectar();

        $conexion->query("UPDATE reservas SET estado='cancelada' WHERE id='$id' AND id_usuario='$user'");
    }

    public function getRoomsByType($tipo){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "SELECT id, num_habitacion, precio 
                FROM habitaciones 
                WHERE id_categoria='$tipo' AND estado='disponible'";

        $conexion->query($sql);

        $result = $conexion->getResult();
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function actualizarReserva($id, $data, $user){
        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "UPDATE reservas SET 
                id_habitacion = '{$data['id_habitacion']}',
                fecha_inicio = '{$data['fecha_inicio']}',
                fecha_final = '{$data['fecha_final']}',
                num_personas = '{$data['num_personas']}',
                precio = '{$data['precio']}',
                id_metodo_pago = '{$data['id_metodo_pago']}'
                WHERE id = '$id' AND id_usuario = '$user'";

        return $conexion->query($sql);
    }


    public function getReservaPorId($id) {
        $conexion = new Conexion();
        $conexion->conectar();

     
        $sql = "SELECT r.*, 
                    h.num_habitacion, 
                    c.nombre as tipo_habitacion,
                    u.name as cliente_nombre, 
                    u.email
                FROM reservas r 
                INNER JOIN habitaciones h ON r.id_habitacion = h.id 
                INNER JOIN categorias c ON h.id_categoria = c.id
                INNER JOIN usuarios u ON r.id_usuario = u.id
                WHERE r.id = '$id'";
                
        $conexion->query($sql);
        $result = $conexion->getResult();
        
        return $result->fetch_assoc();
    }



}