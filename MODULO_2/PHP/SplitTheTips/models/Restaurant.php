<?php
class Restaurant {
    private $conn;
    private $table = 'restaurants';

    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un nuevo restaurante
    public function create() {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s", $this->name);

        return $stmt->execute();
    }

    // Obtener todos los restaurantes
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);

        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}
?>
