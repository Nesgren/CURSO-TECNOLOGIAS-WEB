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
                echo "<p><strong>Nombre:</strong> " . htmlspecialchars($_POST['nombre']) . "</p>";
                echo "<p><strong>Apellido:</strong> " . htmlspecialchars($_POST['apellido']) . "</p>";
                echo "<p><strong>Edad:</strong> " . (isset($_POST['edad']) ? htmlspecialchars($_POST['edad']) : "No especificado") . "</p>";
                
                echo "<p><strong>Intereses:</strong> ";
                if (isset($_POST['intereses'])) {
                    $intereses = $_POST['intereses'];
                    $interesesTexto = '';
                    foreach ($intereses as $interes) {
                        $interesesTexto . htmlspecialchars($interes) . ", ";
                    }
                    echo $interesesTexto;
                } else {
                    echo "Ninguno seleccionado";
                }
                echo "</p>";

                echo "<p><strong>Comentarios:</strong> " . htmlspecialchars($_POST['comentarios']) . "</p>";
            } else {
                echo "<p>No se recibieron datos del formulario.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>