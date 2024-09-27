<?php
require_once 'config/database.php';
require_once 'Expediente.php';

class GestorExpedientes {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerExpedientes() {
        try {
            $query = "SELECT * FROM expedientes";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $expedientes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $expedientes[] = new Expediente($row);
            }
            return $expedientes;
        } catch (PDOException $e) {
            error_log('Error al obtener expedientes: ' . $e->getMessage());
            return [];
        }
    }

    public function obtenerExpedientePorId($id) {
        try {
            $query = "SELECT * FROM expedientes WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? new Expediente($row) : null;
        } catch (PDOException $e) {
            error_log('Error al obtener expediente por ID: ' . $e->getMessage());
            return null;
        }
    }

    public function crearExpediente($expediente) {
        try {
            $query = "INSERT INTO expedientes (nombre, apellido1, apellido2, email, actitud, archivo, idiomas, actividades) 
                      VALUES (:nombre, :apellido1, :apellido2, :email, :actitud, :archivo, :idiomas, :actividades)";
            $stmt = $this->conn->prepare($query);

            $data = $expediente->toArray();

            $stmt->execute([
                ':nombre' => $data['nombre'],
                ':apellido1' => $data['apellido1'],
                ':apellido2' => $data['apellido2'],
                ':email' => $data['email'],
                ':actitud' => $data['actitud'],
                ':archivo' => $data['archivo'],
                ':idiomas' => $data['idiomas'],
                ':actividades' => $data['actividades']
            ]);
        } catch (PDOException $e) {
            error_log('Error al crear expediente: ' . $e->getMessage());
        }
    }

    public function actualizarExpediente($expediente) {
        try {
            $query = "UPDATE expedientes 
                      SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, email = :email, 
                          actitud = :actitud, archivo = :archivo, idiomas = :idiomas, actividades = :actividades 
                      WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $data = $expediente->toArray();

            $stmt->execute([
                ':id' => $data['id'],
                ':nombre' => $data['nombre'],
                ':apellido1' => $data['apellido1'],
                ':apellido2' => $data['apellido2'],
                ':email' => $data['email'],
                ':actitud' => $data['actitud'],
                ':archivo' => $data['archivo'],
                ':idiomas' => $data['idiomas'],
                ':actividades' => $data['actividades']
            ]);
        } catch (PDOException $e) {
            error_log('Error al actualizar expediente: ' . $e->getMessage());
        }
    }

    public function eliminarExpediente($id) {
        try {
            $query = "DELETE FROM expedientes WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log('Error al eliminar expediente: ' . $e->getMessage());
        }
    }
}
?>
