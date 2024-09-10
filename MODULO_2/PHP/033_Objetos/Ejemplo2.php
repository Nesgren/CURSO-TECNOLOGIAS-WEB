<?php

class Persona {
    // Atributos
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fechaNac;
    private $genero;

    // Constructores
    function __construct($nombre, $apellido1, $apellido2, $fechaNac, $genero) {
        $this->setNombre($nombre);
        $this->setApellido1($apellido1);
        $this->setApellido2($apellido2);
        $this->setFechaNac($fechaNac);
        $this->setGenero($genero);
    }

    // Métodos setters
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    // Métodos getters
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
        return 'verDatosFuncion:<br><br> ' . $this->getNombre() . " " . $this->getApellido1() . " " . $this->getApellido2() . " " . $this->getFechaNac() . " " . $this->getGenero() . "<br>";
    }
}

$franco = new Persona('Franco', 'Zuccorononno', 'Sutera', '31/03/1995', 'Masculino');

echo $franco->VerDatos();
echo "<br>";
echo $franco->VerDatosFuncion();

$bruno = new Persona('Bruno', 'Zuccorononno', 'Sutera', '31/03/1995', 'Masculino');

echo "<hr>";

echo $bruno->VerDatos();
echo "<br>";
echo $bruno->VerDatosFuncion();
?>