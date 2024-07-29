<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Factorial</title>
</head>

<body>
    <?php
    $numero = $_POST['number'];
    $resultado = 1;

    if ($numero >= 0) {
        for ($i = $numero; $i > 0; $i--) {
            $resultado *= $i;
        }
        echo "<h2>El factorial de $numero es $resultado.</h2>";
    } else {
        echo "<h2>Por favor, introduce un número entero no negativo.</h2>";
    }
    ?>
</body>

</html>