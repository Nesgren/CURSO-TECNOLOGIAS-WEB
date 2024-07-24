<pre>
<?php
    print_r($_POST);
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $area = $num1 * $num2;
    echo $area;
?>
</pre>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Area</h1>
    <p>El area es: <?php echo $area ?></p>
</body>
</html>