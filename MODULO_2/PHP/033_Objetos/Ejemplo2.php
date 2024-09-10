<?php

class Persona {
    // Atributos
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $fechaNac;
    public $genero;
    // Metodos
    function getNombre() {
        return $this->nombre;
    }

    function getApellido1() {
        return $this->apellido1;
    }

    function getApellido2() {
        return $this->apellido2;
    }

    function getFechaNac() {
        return $this->fechaNac;
    }

    function getGenero() { 
        return $this->genero;
    }
}

$franco = new Persona();
$franco->nombre = "Franco";
$franco->apellido1 = "Zuccorononno";
$franco->apellido2 = "Sutera";
$franco->fechaNac = "23/11/1993";
$franco->genero = "Masculino";

echo $franco->getNombre() . " " . $franco->getApellido1() . " " . $franco->getApellido2() . " " . $franco->getFechaNac() . " " . $franco->getGenero();

$bruno = new Persona();
$bruno->nombre = "Bruno";
$bruno->apellido1 = "Zuccorononno";
$bruno->apellido2 = "Sutera";
$bruno->fechaNac = "31/03/1995";
$bruno->genero = "Masculino";

echo "<hr>";

echo $bruno->nombre . " " . $bruno->apellido1 . " " . $bruno->apellido2 . " " . $bruno->fechaNac . " " . $bruno->genero;
