<?php
include_once '../models/User.php';
include_once '../config/database.php';

class UserController {
    private $db;
    private $model;

    public function __construct() {
        $this->db = new Database();
        $this->model = new User($this->db->getConnection());
    }

    // Método para registrar un nuevo usuario
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->name = $_POST['name'];
            $this->model->email = $_POST['email'];
            $this->model->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $this->model->role = $_POST['role'];

            if ($this->model->create()) {
                header("Location: ../views/auth/login.php");
                exit();
            } else {
                echo "Error al registrar el usuario";
            }
        }
    }

    // Método para obtener todos los empleados
    public function getAllEmployees() {
        $query = "SELECT * FROM users WHERE role = 'employee'";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
