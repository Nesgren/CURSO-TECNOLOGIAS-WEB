<?php include_once '../../controllers/WorkAreaController.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calcular Propinas</title>
</head>
<body>
    <h1>Calcular y Distribuir Propinas</h1>

    <!-- Formulario para ingresar propinas totales -->
    <form action="../../controllers/TipController.php?action=calculate" method="POST">
        <label for="total_tips">Propinas Totales:</label>
        <input type="number" name="total_tips" required>

        <button type="submit">Calcular Distribución</button>
    </form>

    <!-- Resultado de la distribución de propinas -->
    <h2>Distribución de Propinas por Áreas</h2>
    <ul>
        <?php
        // Lógica para obtener las áreas y distribuir las propinas
        if (isset($tipDistribution)) {
            foreach ($tipDistribution as $area => $amount) {
                echo "<li>Área: $area | Monto Distribuido: $amount</li>";
            }
        }
        ?>
    </ul>
</body>
</html>
