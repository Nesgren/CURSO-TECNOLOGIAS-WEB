<?php
require_once 'config/database.php';

class Book {
    private $conn;
    private $table = 'books';

    public $id;
    public $title;
    public $author;
    public $year;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los libros
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear libro
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET title=:title, author=:author, year=:year";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':year', $this->year);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar libro
    public function update() {
        $query = "UPDATE " . $this->table . " SET title=:title, author=:author, year=:year WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar libro
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
