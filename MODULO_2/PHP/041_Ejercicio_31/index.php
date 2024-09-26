<?php
require_once 'controllers/ExpedienteController.php';

$controller = new ExpedienteController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'crear':
            $controller->crear();
            break;
        case 'editar':
            $controller->editar($_GET['id']);
            break;
        case 'eliminar':
            $controller->eliminar($_GET['id']);
            break;
        default:
            $controller->index();
    }
} else {
    $controller->index();
}
?>
