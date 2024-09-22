<?php
include_once '../models/WorkArea.php';
include_once '../models/EmployeeWorkArea.php';
include_once '../config/database.php';

class TipController {
    private $db;
    private $workAreaModel;
    private $employeeWorkAreaModel;

    public function __construct() {
        $this->db = new Database();
        $this->workAreaModel = new WorkArea($this->db->getConnection());
        $this->employeeWorkAreaModel = new EmployeeWorkArea($this->db->getConnection());
    }

    // Método para calcular la distribución de propinas
    public function calculateTips() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $totalTips = $_POST['total_tips'];

            // Obtener todas las áreas de trabajo
            $areas = $this->workAreaModel->getAll();

            // Iniciar el array de distribución
            $tipDistribution = [];

            // Calcular la distribución para cada área
            foreach ($areas as $area) {
                $percentage = $area['tip_percentage'];
                $areaTipAmount = ($totalTips * $percentage) / 100;

                // Obtener los empleados en esa área
                $employees = $this->employeeWorkAreaModel->getEmployeesByArea($area['id']);
                $totalHours = array_sum(array_column($employees, 'hours_worked'));

                // Distribuir propinas entre los empleados según las horas trabajadas
                foreach ($employees as $employee) {
                    $employeeShare = ($employee['hours_worked'] / $totalHours) * $areaTipAmount;
                    $tipDistribution[$area['name']][] = [
                        'employee_id' => $employee['employee_id'],
                        'amount' => $employeeShare
                    ];
                }
            }

            // Aquí podrías devolver la distribución para mostrarla en la vista o guardarla en base de datos
            return $tipDistribution;
        }
    }
}
?>
