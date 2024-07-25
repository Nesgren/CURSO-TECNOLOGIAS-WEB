<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de la Compra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Resultado de la Compra</h1>
    <?php
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $descuento = 0;

        if ($cantidad == 1) {
            $descuento = 0;
        } elseif ($cantidad == 2) {
            $descuento = 0.10;
        } elseif ($cantidad == 3) {
            $descuento = 0.15;
        } elseif ($cantidad == 4) {
            $descuento = 0.20;
        } elseif ($cantidad >= 5) {
            $descuento = 0.25;
        } else {
            echo "<p>Algo salió mal</p>";
        }

        $total = $cantidad * $precio * (1 - $descuento);
        if ($descuento > 0) {
            echo "<p>Total a pagar por {$cantidad} entradas: $" . ($total) . "</p>";
        }
    ?>
    <a href="index.html">Volver a la página de compra</a>
</body>
</html>
