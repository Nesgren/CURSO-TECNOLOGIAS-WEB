<?php

class Persona {
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $fechaNac;
    public $genero;
}

$franco = new Persona();
$franco->nombre = "Franco";
$franco->apellido1 = "Zuccorononno";
$franco->apellido2 = "Sutera";
$franco->fechaNac = "23/11/1993";
$franco->genero = "Masculino";

echo $franco->nombre . " " . $franco->apellido1 . " " . $franco->apellido2 . " " . $franco->fechaNac . " " . $franco->genero;

$bruno = new Persona();
$bruno->nombre = "Bruno";
$bruno->apellido1 = "Zuccorononno";
$bruno->apellido2 = "Sutera";
$bruno->fechaNac = "31/03/1995";
$bruno->genero = "Masculino";

echo "<hr>";

echo $bruno->nombre . " " . $bruno->apellido1 . " " . $bruno->apellido2 . " " . $bruno->fechaNac . " " . $bruno->genero;
