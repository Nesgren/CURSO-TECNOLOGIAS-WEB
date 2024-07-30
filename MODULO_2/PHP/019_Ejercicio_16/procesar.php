<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Formulario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Resultados del Formulario</h1>
        <div class="resultado">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = htmlspecialchars($_POST['nombre']);
                $apellido = htmlspecialchars($_POST['apellido']);
                $edad = isset($_POST['edad']) ? htmlspecialchars($_POST['edad']) : "No especificado";
                $intereses = isset($_POST['intereses']);
                $comentarios = htmlspecialchars($_POST['comentarios']);
                
                echo "<p><strong>Nombre:</strong> $nombre</p>";
                echo "<p><strong>Apellido:</strong> $apellido</p>";
                echo "<p><strong>Edad:</strong> $edad</p>";
                echo "<p><strong>Intereses:</strong> $intereses</p>";
                echo "<p><strong>Comentarios:</strong> $comentarios</p>";
            } else {
                echo "<p>No se recibieron datos del formulario.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
