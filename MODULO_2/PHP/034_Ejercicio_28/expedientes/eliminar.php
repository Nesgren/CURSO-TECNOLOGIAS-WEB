<?php
// expedientes/eliminar.php
require_once '../clases/GestorExpedientes.php';

$gestor = new GestorExpedientes('../data/expedientes.json');
$gestor->eliminarExpediente($_GET['id']);

header('Location: index.php');
exit;
?>
