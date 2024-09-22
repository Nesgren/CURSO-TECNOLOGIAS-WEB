<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'SplitTheTips';
    private $username = 'franco1';
    private $password = 'Nascor2020!';
    public $conn;

    // Conectar a la base de datos
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>