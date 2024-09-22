<?php
require_once 'models/NombresModel.php';

class NombresController {
    private $model;

    public function __construct() {
        session_start();
        $this->model = new NombresModel();
    }

    // Método principal para manejar la lógica
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])) {
            $this->model->addNombre($_POST['nombre']);
        }

        if (isset($_GET['delete'])) {
            $this->model->deleteNombre($_GET['delete']);
        }

        // Obtener los nombres y mostrarlos
        $nombres = $this->model->getNombres();
        require 'views/nombres_view.php';
    }
}
