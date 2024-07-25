<?php
$grade = $_POST["grade"];
$letter = '';

if ($grade >= 19 && $grade <= 20) {
    $letter = 'A';
} elseif ($grade >= 16 && $grade <= 18) {
    $letter = 'B';
} elseif ($grade >= 12 && $grade <= 15) {
    $letter = 'C';
} elseif ($grade >= 9 && $grade <= 11) {
    $letter = 'D';
} elseif ($grade >= 0 && $grade <= 8) {
    $letter = 'E';
} else {
    $letter = 'Calificación inválida';
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
        <button href="index.html">Volver</button>
    </div>
</body>

</html>
