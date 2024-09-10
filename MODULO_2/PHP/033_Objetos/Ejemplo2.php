<?php

class Persona {
    // Atributos
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fechaNac;
    private $genero;

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

$franco = new Persona();
$franco->setNombre('Franco');
$franco->setApellido1('Zuccorononno');
$franco->setApellido2('Sutera');
$franco->setFechaNac('23/11/1993');
$franco->setGenero('Masculino');

echo $franco->VerDatos();
echo "<hr>";
echo $franco->VerDatosFuncion();

$bruno = new Persona();
$bruno->setNombre('Bruno');
$bruno->setApellido1('Zuccorononno');
$bruno->setApellido2('Sutera');
$bruno->setFechaNac('31/03/1995');
$bruno->setGenero('Masculino'); 

echo "<hr>";

echo $bruno->VerDatos();
echo "<hr>";
echo $bruno->VerDatosFuncion();
?>
