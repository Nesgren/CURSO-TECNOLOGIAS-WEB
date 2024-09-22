<?php
include_once '../models/Restaurant.php';
include_once '../config/database.php';

class RestaurantController {
    private $db;
    private $model;

    public function __construct() {
        $this->db = new Database();
        $this->model = new Restaurant($this->db->getConnection());
    }

    // Método para crear un nuevo restaurante
    public function createRestaurant() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->name = $_POST['name'];

            if ($this->model->create()) {
                header("Location: /admin/dashboard.php");
            } else {
                echo "Error al crear el restaurante";
            }
        }
    }

    // Método para listar todos los restaurantes
    public function listRestaurants() {
        return $this->model->getAll();
    }
}
?>
