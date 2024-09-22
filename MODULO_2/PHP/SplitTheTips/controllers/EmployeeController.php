<?php
include_once '../models/EmployeeWorkArea.php'; // Asegúrate de que esta ruta sea correcta
include_once '../config/database.php';

class EmployeeController {
    private $db;
    private $model;

    public function __construct() {
        $this->db = new Database();
        $this->model = new EmployeeWorkArea($this->db->getConnection());
    }

    public function assignEmployeeToArea() {
        if (isset($_POST['employee_id'], $_POST['work_area_id'], $_POST['hours_worked'])) {
            $this->model->employee_id = $_POST['employee_id'];
            $this->model->work_area_id = $_POST['work_area_id'];
            $this->model->hours_worked = $_POST['hours_worked'];
            $this->model->addEmployee(); // Método para asignar empleado
        }
    }

    public function getEmployeesByArea($work_area_id) {
        return $this->model->getEmployeesByArea($work_area_id); // Asegúrate que este método exista en el modelo
    }

    public function getEmployeeHours($employee_id) {
        return $this->model->getHoursByEmployee($employee_id);
    }

    public function getEmployeeTips($employee_id) {
        return $this->model->getTipsByEmployee($employee_id);
    }
    
}
?>
