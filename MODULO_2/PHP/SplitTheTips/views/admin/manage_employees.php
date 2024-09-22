<?php 
include_once '../../controllers/EmployeeController.php'; 
include_once '../../controllers/WorkAreaController.php'; 
include_once '../../controllers/UserController.php'; 
session_start();

$userController = new UserController();
$workAreaController = new WorkAreaController();
$employeeController = new EmployeeController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['assign_employee'])) {
        $employeeController->assignEmployeeToArea();
    }
}

// Obtener todas las áreas de trabajo
$areas = $workAreaController->listWorkAreas();
$employees = $userController->getAllEmployees();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Empleados</title>
</head>
<body>
    <h1>Gestionar Empleados en Áreas de Trabajo</h1>

    <!-- Formulario para asignar empleado a un área de trabajo -->
    <form action="" method="POST">
        <label for="employee_id">Empleado:</label>
        <select name="employee_id" required>
            <?php foreach ($employees as $employee): ?>
                <option value="<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="work_area_id">Área de Trabajo:</label>
        <select name="work_area_id" required>
            <?php foreach ($areas as $area): ?>
                <option value="<?php echo $area['id']; ?>"><?php echo $area['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="hours_worked">Horas trabajadas:</label>
        <input type="number" name="hours_worked" required>

        <button type="submit" name="assign_employee">Asignar Empleado</button>
    </form>

    <h2>Empleados Asignados a Áreas de Trabajo</h2>
    <ul>
        <?php foreach ($areas as $area): ?>
            <h3><?php echo $area['name']; ?></h3>
            <?php
            // Obtener empleados por área
            $employeesInArea = $employeeController->getEmployeesByArea($area['id']);
            if (!empty($employeesInArea)):
                foreach ($employeesInArea as $employee): ?>
                    <li>Empleado: <?php echo $employee['employee_id']; ?> | Horas Trabajadas: <?php echo $employee['hours_worked']; ?></li>
                <?php endforeach; 
            else: ?>
                <p>No hay empleados asignados a esta área.</p>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</body>
</html>
