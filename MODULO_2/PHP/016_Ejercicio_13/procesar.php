<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Mayor de Cuatro Números</title>
</head>

<body>
    <div class="container">
        <?php
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $num3 = $_POST['num3'];
        $num4 = $_POST['num4'];

        $mayor = $num1;
        if ($num2 > $mayor) {
            $mayor = $num2;
        }
        if ($num3 > $mayor) {
            $mayor = $num3;
        }
        if ($num4 > $mayor) {
            $mayor = $num4;
        }

        echo "El número mayor es: " . $mayor;
        ?>

    </div>
</body>

</html>