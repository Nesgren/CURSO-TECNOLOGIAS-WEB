<?php
require_once '../config/database.php';
require_once 'Expediente.php';

class GestorExpedientes {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerExpedientes() {
        $query = "SELECT * FROM expedientes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $expedientes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $expedientes[] = new Expediente($row);
        }

        return $expedientes;
    }

    public function obtenerExpedientePorId($id) {
        $query = "SELECT * FROM expedientes WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Expediente($row);
        }
        return null;
    }

    public function crearExpediente($expediente) {
        $query = "INSERT INTO expedientes (nombre, apellido1, apellido2, email, actitud, archivo, idiomas, actividades) 
                  VALUES (:nombre, :apellido1, :apellido2, :email, :actitud, :archivo, :idiomas, :actividades)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($expediente->toArray());
    }

    public function actualizarExpediente($expediente) {
        $query = "UPDATE expedientes 
                  SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, email = :email, 
                      actitud = :actitud, archivo = :archivo, idiomas = :idiomas, actividades = :actividades 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($expediente->toArray());
    }

    public function eliminarExpediente($id) {
        $query = "DELETE FROM expedientes WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }
}
?>
