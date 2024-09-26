<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'franco_bbdd1';
    private $username = 'franco'; // Cambia a tu usuario
    private $password = 'Nascor2020!'; // Cambia a tu contraseña
    public $conn;

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
