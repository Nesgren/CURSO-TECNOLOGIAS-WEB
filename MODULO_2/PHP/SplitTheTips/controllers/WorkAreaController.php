<?php
include_once '../models/WorkArea.php'; // Asegúrate de que esta ruta sea correcta
include_once '../config/database.php';

class WorkAreaController {
    private $db;
    private $model;

    public function __construct() {
        $this->db = new Database();
        $this->model = new WorkArea($this->db->getConnection());
    }

    public function listWorkAreas() {
        return $this->model->getAll();
    }

    public function addArea() {
        if (isset($_POST['name'])) {
            $this->model->name = $_POST['name'];
            $this->model->create(); // Método en el modelo para agregar área
        }
    }

    public function deleteArea($id) {
        $this->model->id = $id;
        $this->model->delete(); // Método en el modelo para eliminar área
    }

    public function updateArea($id) {
        $this->model->id = $id;
        $this->model->name = $_POST['name'];
        $this->model->update(); // Método en el modelo para actualizar área
    }
}
?>
