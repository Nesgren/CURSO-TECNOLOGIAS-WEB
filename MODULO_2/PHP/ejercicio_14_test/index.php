<?php
$coches = [
    [
        "marca" => "Volkswagen",
        "modelo" => "Golf",
        "año" => 2021,
        "color" => "Gris",
        "matricula" => "DE-456-FG"
    ],
    [
        "marca" => "BMW",
        "modelo" => "Serie 3",
        "año" => 2019,
        "color" => "Blanco",
        "matricula" => "HI-789-JK"
    ],
    [
        "marca" => "Renault",
        "modelo" => "Clio",
        "año" => 2020,
        "color" => "Rojo",
        "matricula" => "LM-123-NO"
    ],
    [
        "marca" => "Peugeot",
        "modelo" => "208",
        "año" => 2018,
        "color" => "Azul",
        "matricula" => "PQ-456-RS"
    ],
    [
        "marca" => "Audi",
        "modelo" => "A4",
        "año" => 2022,
        "color" => "Negro",
        "matricula" => "TU-789-VW"
    ]
];

foreach ($coches as $coche) {
    echo "<div class='car-item'>";
    echo "<p>Marca: {$coche['marca']}</p>";
    echo "<p>Modelo: {$coche['modelo']}</p>";
    echo "<p>Año: {$coche['año']}</p>";
    echo "<p>Color: {$coche['color']}</p>";
    echo "<p>Matrícula: {$coche['matricula']}</p>";
    echo "</div>";
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevaMarca = $_POST['marca'];
    $nuevoModelo = $_POST['modelo'];
    $nuevoAno = $_POST['ano'];
    $nuevoColor = $_POST['color'];
    $nuevaMatricula = $_POST['matricula'];

    if (!empty($nuevaMarca) && !empty($nuevoModelo) && !empty($nuevoAno) && !empty($nuevoColor) && !empty($nuevaMatricula)) {
        echo "<h1>Nuevo coche agregado con éxito</h1>";
        echo "<p>Marca: " . htmlspecialchars($nuevaMarca) . "</p>";
        echo "<p>Modelo: " . htmlspecialchars($nuevoModelo) . "</p>";
        echo "<p>Año: " . htmlspecialchars($nuevoAno) . "</p>";
        echo "<p>Color: " . htmlspecialchars($nuevoColor) . "</p>";
        echo "<p>Matrícula: " . htmlspecialchars($nuevaMatricula) . "</p>";
    } else {
        echo "<h1>Error</h1>";
        echo "<p>Por favor, rellene todos los campos.</p>";
    }
} else {
    echo "<h1>Error</h1>";
    echo "<p>Método de solicitud no permitido.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Agregar Coche</title>
</head>

<body>
    <div class="container">
        <h1>Agregar un nuevo coche</h1>
        <form action="agregarCoche.php" method="POST">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="ano">Año:</label>
            <input type="number" id="ano" name="ano" required>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <button type="submit">Agregar Coche</button>
        </form>
    </div>
</body>

</html>