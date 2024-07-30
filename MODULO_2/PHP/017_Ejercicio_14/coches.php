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

echo "<pre>";

foreach ($coches as $coche) {
    echo "Marca: " . $coche['marca'] . '<br>';
    echo "Modelo: " . $coche['modelo'] . '<br>';
    echo "Año: " . $coche['año'] . '<br>';
    echo "Color: " . $coche['color'] . '<br>';
    echo "Matrícula: " . $coche['matricula'] . '<br>';
    echo '<hr>';
}

echo "</pre>";
?>
