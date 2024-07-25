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

        switch ($cantidad) {
            case 1:
                $descuento = 0;
                break;
            case 2:
                $descuento = 0.10;
                break;
            case 3:
                $descuento = 0.15;
                break;
            case 4:
                $descuento = 0.20;
                break;
            case ($cantidad >= 5):
                $descuento = 0.25;
                break;
        }
        if ($cantidad <= 0) {
            echo "<p>Algo salió mal</p>";
        }
        $total = $cantidad * $precio * (1 - $descuento);
        echo "<p>Total a pagar por {$cantidad} entradas: $" . ($total) . "</p>";
    ?>
    <a href="index.html">Volver a la página de compra</a>
</body>
</html>
