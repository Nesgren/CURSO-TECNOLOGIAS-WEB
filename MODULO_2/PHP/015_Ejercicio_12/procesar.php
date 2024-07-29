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
        if (isset($_POST['dato1']) && isset($_POST['dato2']) && isset($_POST['dato3']) && 
            isset($_POST['dato4']) && isset($_POST['dato5']) && isset($_POST['dato6'])) {
            
            $datos = [
                $_POST['dato1'],
                $_POST['dato2'],
                $_POST['dato3'],
                $_POST['dato4'],
                $_POST['dato5'],
                $_POST['dato6']
            ];
            
            $datosLength = count($datos);
            
            for ($i = $datosLength - 1; $i >= 0; $i--) {
                echo "<li>" . htmlspecialchars($datos[$i]) . "</li>";
            }
        } else {
            echo "<p>No se recibieron todos los datos.</p>";
        }
        ?>
    </ul>
    <a href="index.html">Volver</a>
</body>
</html>
