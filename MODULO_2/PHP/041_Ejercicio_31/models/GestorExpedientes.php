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
        
        // Debugging output
        $data = $expediente->toArray();
        var_dump($data); // Verificar qué datos se están enviando

        // Asegurarse de que todos los datos sean válidos
        $stmt->execute([
            ':nombre' => $data['nombre'],
            ':apellido1' => $data['apellido1'],
            ':apellido2' => $data['apellido2'],
            ':email' => $data['email'],
            ':actitud' => $data['actitud'],
            ':archivo' => $data['archivo'],
            ':idiomas' => $data['idiomas'], // Este debe ser una cadena JSON
            ':actividades' => $data['actividades'], // Este debe ser una cadena JSON
        ]);
    }

    public function actualizarExpediente($expediente) {
        $query = "UPDATE expedientes 
                  SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, email = :email, 
                      actitud = :actitud, archivo = :archivo, idiomas = :idiomas, actividades = :actividades 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Asegúrate de que 'id' esté presente en el array
        $data = $expediente->toArray();
        $data[':id'] = $data['id'];

        // Debugging output
        var_dump($data); // Verificar qué datos se están enviando

        $stmt->execute($data);
    }

    public function eliminarExpediente($id) {
        $query = "DELETE FROM expedientes WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }
}
?>
