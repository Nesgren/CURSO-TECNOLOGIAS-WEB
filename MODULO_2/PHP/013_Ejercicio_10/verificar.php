<?php

$dni = $_POST["dni"];
$letra_usuario = $_POST["letra"];

$letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

if ($dni < 0 || $dni > 99999999) {
    echo "<p>El número de DNI proporcionado no es válido.</p>";
} else {
    $indice = $dni % 23;
    $letra_correcta = $letras[$indice];

    if ($letra_correcta == $letra_usuario) {
        echo "<p>El número y la letra del DNI son correctos.</p>";
    } else {
        echo "<p>La letra que ha indicado no es correcta. La letra correcta es $letra_correcta.</p>";
    }
}
