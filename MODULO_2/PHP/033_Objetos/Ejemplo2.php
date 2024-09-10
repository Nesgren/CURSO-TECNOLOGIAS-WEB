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

    function VerDatos() {
        echo $this->getNombre() . " " . $this->getApellido1() . " " . $this->getApellido2() . " " . $this->getFechaNac() . " " . $this->getGenero() . "<br>";
    }

    function VerDatosFuncion() {
        return 'verDatosFuncion:<br>' . $this->getNombre() . " " . $this->getApellido1() . " " . $this->getApellido2() . " " . $this->getFechaNac() . " " . $this->getGenero();
    }
}

$franco = new Persona();
$franco->nombre = "Franco";
$franco->apellido1 = "Zuccorononno";
$franco->apellido2 = "Sutera";
$franco->fechaNac = "23/11/1993";
$franco->genero = "Masculino";

echo $franco->VerDatos();

echo $franco->VerDatosFuncion();

$bruno = new Persona();
$bruno->nombre = "Bruno";
$bruno->apellido1 = "Zuccorononno";
$bruno->apellido2 = "Sutera";
$bruno->fechaNac = "31/03/1995";
$bruno->genero = "Masculino";

echo "<hr>";

echo $bruno->VerDatos();

