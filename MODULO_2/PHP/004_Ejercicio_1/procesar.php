<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Enviados</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    $nombre = htmlspecialchars($_GET['nombre']);
    $email = htmlspecialchars($_GET['email']);
    $opciones = htmlspecialchars($_GET['opciones']);
    $opciones2 = htmlspecialchars($_GET['opciones2']);
    $gusta_sitio = htmlspecialchars($_GET['gusta_sitio']);
    $suscripcion = htmlspecialchars($_GET['suscripcion']);
    $comentarios = htmlspecialchars($_GET['comentarios']);

    echo "<h1>Datos Enviados</h1>";
    echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
    echo "<p><strong>Correo Electrónico:</strong> " . $email . "</p>";
    echo "<p><strong>Opción Seleccionada:</strong> " . $opciones . "</p>";
    echo "<p><strong>Otra Opción Seleccionada:</strong> " . $opciones2 . "</p>";
    echo "<p><strong>¿Te gusta nuestro sitio web?:</strong> " . $gusta_sitio . "</p>";
    echo "<p><strong>Suscripción al boletín:</strong> " . $suscripcion . "</p>";
    echo "<p><strong>Comentarios:</strong> " . $comentarios . "</p>";
    ?>
</body>
</html>
