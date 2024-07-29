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
        $numeros = [
            $_POST['num1'],
            $_POST['num2'],
            $_POST['num3'],
            $_POST['num4']
        ];

        $mayor = $numeros[0];
        for ($i = 1; $i < count($numeros); $i++) {
            if ($numeros[$i] > $mayor) {
                $mayor = $numeros[$i];
            }
        }

        echo "El número mayor es: " . $mayor;
        ?>
    </div>
</body>

</html>
