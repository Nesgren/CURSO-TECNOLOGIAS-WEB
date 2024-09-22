<?php include_once '../../controllers/EmployeeController.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Empleados</title>
</head>
<body>
    <h1>Panel de Control de Empleados</h1>

    <h2>Horas trabajadas</h2>
    <ul>
        <?php
        session_start();
        $controller = new EmployeeController();
        $employeeHours = $controller->getEmployeeHours($_SESSION['user_id']);
        foreach ($employeeHours as $record) {
            echo "<li>Área: " . $record['work_area_id'] . " | Horas: " . $record['hours_worked'] . "</li>";
        }
        ?>
    </ul>

    <h2>Propinas Recibidas</h2>
    <ul>
        <?php
        $employeeTips = $controller->getEmployeeTips($_SESSION['user_id']);
        echo "<li>Total de Propinas: " . ($employeeTips['total_tips'] ? $employeeTips['total_tips'] : 0) . "</li>";
        ?>
    </ul>
</body>
</html>
