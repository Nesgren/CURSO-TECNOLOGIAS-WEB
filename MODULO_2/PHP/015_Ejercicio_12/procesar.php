<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Datos Invertidos</title>
</head>
<body>
    <h1>Datos Ingresados en Orden Inverso</h1>
    <ul>
        <?php
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
            $dataLength = count($data);
            
            for ($i = $dataLength - 1; $i >= 0; $i--) {
                echo "<li>" . htmlspecialchars($data[$i]) . "</li>";
            }
        } else {
            echo "<p>No se recibieron datos.</p>";
        }
        ?>
    </ul>
    <a href="index.html">Volver</a>
</body>
</html>
