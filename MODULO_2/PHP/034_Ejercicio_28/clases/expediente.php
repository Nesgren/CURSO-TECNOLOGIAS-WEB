<?php
class Expediente {
    private $id;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $email;
    private $actividades;
    private $actitud;
    private $idiomas;
    private $archivo;

    public function __construct($id, $nombre, $apellido1, $apellido2, $email, $actividades, $actitud, $idiomas, $archivo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->email = $email;
        $this->actividades = $actividades;
        $this->actitud = $actitud;
        $this->idiomas = $idiomas;
        $this->archivo = $archivo;
    }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getActividades() {
        return $this->actividades;
    }

    public function setActividades($actividades) {
        $this->actividades = $actividades;
    }

    public function getActitud() {
        return $this->actitud;
    }

    public function setActitud($actitud) {
        $this->actitud = $actitud;
    }

    public function getIdiomas() {
        return $this->idiomas;
    }

    public function setIdiomas($idiomas) {
        $this->idiomas = $idiomas;
    }

    public function getArchivo() {
        return $this->archivo;
    }

    public function setArchivo($archivo) {
        $this->archivo = $archivo;
    }
}
?>
