<?php 
include_once '../../controllers/WorkAreaController.php'; 
session_start();

$workAreaController = new WorkAreaController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_area'])) {
        $workAreaController->addArea();
    } elseif (isset($_POST['delete_area'])) {
        $workAreaController->deleteArea($_POST['id']);
    } elseif (isset($_POST['update_area'])) {
        $workAreaController->updateArea($_POST['id']);
    }
}

// Obtener todas las áreas
$areas = $workAreaController->listWorkAreas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Áreas de Trabajo</title>
</head>
<body>
    <h1>Gestionar Áreas de Trabajo</h1>

    <form action="" method="POST">
        <input type="hidden" name="id" id="area_id" value="">
        <label for="name">Nombre del Área:</label>
        <input type="text" name="name" required>

        <button type="submit" name="add_area">Agregar Área</button>
    </form>

    <h2>Áreas de Trabajo Existentes</h2>
    <ul>
        <?php foreach ($areas as $area): ?>
            <li>
                <?php echo $area['name']; ?>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $area['id']; ?>">
                    <button type="submit" name="delete_area">Eliminar</button>
                </form>
                <button onclick="editArea('<?php echo $area['id']; ?>', '<?php echo $area['name']; ?>')">Editar</button>
            </li>
        <?php endforeach; ?>
    </ul>

    <script>
        function editArea(id, name) {
            document.getElementById('area_id').value = id;
            document.querySelector('input[name="name"]').value = name;
        }
    </script>
</body>
</html>
