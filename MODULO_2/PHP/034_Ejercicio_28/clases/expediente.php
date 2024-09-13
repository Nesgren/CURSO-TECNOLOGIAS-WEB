<?php
class Expediente {
    public $id;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $email;
    public $actividades;
    public $actitud;
    public $idiomas;
    public $archivo;

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
}
?>
