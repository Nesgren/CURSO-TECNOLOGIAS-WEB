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