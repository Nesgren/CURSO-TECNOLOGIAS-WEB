<?php
class EmployeeWorkArea {
    private $conn;
    public $employee_id;
    public $work_area_id;
    public $hours_worked;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para agregar un empleado a un área
    public function addEmployee() {
        $query = "INSERT INTO employee_work_areas (employee_id, work_area_id, hours_worked) VALUES (:employee_id, :work_area_id, :hours_worked)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':employee_id', $this->employee_id);
        $stmt->bindParam(':work_area_id', $this->work_area_id);
        $stmt->bindParam(':hours_worked', $this->hours_worked);

        return $stmt->execute();
    }

    // Método para obtener empleados por área
    public function getEmployeesByArea($work_area_id) {
        $query = "SELECT employee_id, hours_worked FROM employee_work_areas WHERE work_area_id = :work_area_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':work_area_id', $work_area_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener horas trabajadas por empleado
    public function getHoursByEmployee($employee_id) {
        $query = "SELECT work_area_id, hours_worked FROM employee_work_areas WHERE employee_id = :employee_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTipsByEmployee($employee_id) {
        $query = "SELECT SUM(tip_amount) as total_tips FROM tips WHERE employee_id = :employee_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
