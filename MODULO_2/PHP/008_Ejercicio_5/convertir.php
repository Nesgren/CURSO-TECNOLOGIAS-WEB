<?php
$grade = $_POST["grade"];
$letter = '';

switch (true) {
    case ($grade >= 19 && $grade <= 20):
        $letter = 'A';
        break;
    case ($grade >= 16 && $grade <= 18):
        $letter = 'B';
        break;
    case ($grade >= 12 && $grade <= 15):
        $letter = 'C';
        break;
    case ($grade >= 9 && $grade <= 11):
        $letter = 'D';
        break;
    case ($grade >= 0 && $grade <= 8):
        $letter = 'E';
        break;
    default:
        $letter = 'Calificación inválida';
        break;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Conversión</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Resultado de Conversión</h1>
        <p>La calificación numérica de <?php echo htmlspecialchars($grade); ?> se convierte en la letra: <strong><?php echo $letter; ?></strong></p>
        <a href="index.html">Volver</a>
    </div>
</body>

</html>