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

$mensajeConfirmacion = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevaMarca = $_POST['marca'];
    $nuevoModelo = $_POST['modelo'];
    $nuevoAno = $_POST['ano'];
    $nuevoColor = $_POST['color'];
    $nuevaMatricula = $_POST['matricula'];

    if (!empty($nuevaMarca) && !empty($nuevoModelo) && !empty($nuevoAno) && !empty($nuevoColor) && !empty($nuevaMatricula)) {
        $coches[] = [
            "marca" => htmlspecialchars($nuevaMarca),
            "modelo" => htmlspecialchars($nuevoModelo),
            "año" => htmlspecialchars($nuevoAno),
            "color" => htmlspecialchars($nuevoColor),
            "matricula" => htmlspecialchars($nuevaMatricula)
        ];
        $mensajeConfirmacion = "<h1>Nuevo coche agregado con éxito</h1>
                                <p>Marca: " . htmlspecialchars($nuevaMarca) . "</p>
                                <p>Modelo: " . htmlspecialchars($nuevoModelo) . "</p>
                                <p>Año: " . htmlspecialchars($nuevoAno) . "</p>
                                <p>Color: " . htmlspecialchars($nuevoColor) . "</p>
                                <p>Matrícula: " . htmlspecialchars($nuevaMatricula) . "</p>";
    } else {
        $mensajeConfirmacion = "<h1>Error</h1><p>Por favor, rellene todos los campos.</p>";
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Gestión de Coches</title>
</head>
<body>
    <div class="container">
        <?php if ($action == 'add'): ?>
            <h1>Agregar un nuevo coche</h1>
            <form action="index.php?action=add" method="POST">
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
            <a href="index.php?action=list" class="link">Volver a la lista de coches</a>
        <?php elseif ($action == 'confirm'): ?>
            <?php echo $mensajeConfirmacion; ?>
            <a href="index.php?action=list" class="link">Volver a la lista de coches</a>
        <?php else: ?>
            <h1>Lista de Coches</h1>
            <div class="car-list">
                <?php foreach ($coches as $coche): ?>
                    <div class='car-item'>
                        <p>Marca: <?php echo htmlspecialchars($coche['marca']); ?></p>
                        <p>Modelo: <?php echo htmlspecialchars($coche['modelo']); ?></p>
                        <p>Año: <?php echo htmlspecialchars($coche['año']); ?></p>
                        <p>Color: <?php echo htmlspecialchars($coche['color']); ?></p>
                        <p>Matrícula: <?php echo htmlspecialchars($coche['matricula']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="index.php?action=add" class="link">Agregar un nuevo coche</a>
        <?php endif; ?>
    </div>
</body>
</html>
