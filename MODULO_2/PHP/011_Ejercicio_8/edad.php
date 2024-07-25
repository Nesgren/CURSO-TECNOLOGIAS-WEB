<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Resultado</title>
</head>
<body>
    <div class="container">
        <h1>Resultado</h1>
        <?php
        if (isset($_POST['edad'])) {
            $edad = intval($_POST['edad']);
            if ($edad < 30) {
                echo "<p>Eres una persona <strong>joven</strong>.</p>";
            } else {
                echo "<p>Eres una persona <strong>adulta</strong>.</p>";
            }
        } else {
            echo "<p>No se ha ingresado una edad válida.</p>";
        }
        ?>
        <a href="index.html">Volver</a>
    </div>
</body>
</html>
