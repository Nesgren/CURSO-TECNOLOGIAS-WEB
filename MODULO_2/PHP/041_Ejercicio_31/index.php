<?php
require_once 'controllers/ExpedienteController.php';

$controller = new ExpedienteController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'crear':
            $controller->crear();
            break;
        case 'editar':
            if (isset($_GET['id'])) {
                $controller->editar((int)$_GET['id']);
            } else {
                // Manejar error: ID no proporcionado
                header('Location: index.php');
                exit();
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controller->eliminar((int)$_GET['id']);
            } else {
                // Manejar error: ID no proporcionado
                header('Location: index.php');
                exit();
            }
            break;
        default:
            $controller->index();
    }
} else {
    $controller->index();
}
?>
