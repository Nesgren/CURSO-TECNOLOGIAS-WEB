<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
    $num1 = $_POST('num1');
    $num2 = $_POST('num2');

    if ($num1 > $num2) {
        $resultado_mayor = "El primer número ($num1) es mayor que el segundo número ($num2).";
    } elseif ($num1 == $num2) {
        $resultado_mayor = "El primer número ($num1) es igual al segundo número ($num2).";
    } else {
        $resultado_mayor = "El segundo número ($num2) es mayor que el primer número ($num1).";
    }

    $suma = $num1 + $num2;
?>
<div class="container">
        <h2>Resultados</h2>
        <div class="result">
            <p><?php echo htmlspecialchars($resultado_mayor); ?></p>
            <p>La suma de los dos números es: <?php echo htmlspecialchars($suma); ?></p>
        </div>
        <a href="index.html" class="back-button">Volver al Formulario</a>
    </div>
</body>
</html>