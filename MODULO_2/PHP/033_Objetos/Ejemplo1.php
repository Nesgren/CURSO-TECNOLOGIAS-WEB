<?php
class Coche {
    public $color;
    public $marca;
    public $modelo;
    public $potencia;
}

$miCoche = new Coche();
$miCoche->color = "Rojo";
$miCoche->marca = "Volkswagen";
$miCoche->modelo = "Golf";
$miCoche->potencia = 1.6;

echo $miCoche->color. "<br>";
echo $miCoche->marca. "<br>";
echo $miCoche->modelo. "<br>";

$tuCoche = new Coche();
$tuCoche->color = "Azul";
$tuCoche->marca = "Peugeot";
$tuCoche->modelo = "308";
$tuCoche->potencia = 2.0;

echo $tuCoche->color. "<br>";    
echo $tuCoche->marca. "<br>";
echo $tuCoche->modelo. "<br>";