<?php
$nombre = htmlspecialchars($_POST['nombre']);
$email = htmlspecialchars($_POST['email']);
$opciones = htmlspecialchars($_POST['opciones']);
$comentarios = htmlspecialchars($_POST['comentarios']);

echo "<h1>Datos Enviados</h1>";
echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
echo "<p><strong>Correo Electrónico:</strong> " . $email . "</p>";
echo "<p><strong>Opción Seleccionada:</strong> " . $opciones . "</p>";
echo "<p><strong>Comentarios:</strong> " . ($comentarios) . "</p>";
?>