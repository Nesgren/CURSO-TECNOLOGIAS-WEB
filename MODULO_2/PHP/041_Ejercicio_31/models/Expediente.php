<?php
class Expediente {
    public $id;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $email;
    public $actitud;
    public $archivo;
    public $idiomas;
    public $actividades;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->apellido1 = $data['apellido1'];
        $this->apellido2 = $data['apellido2'];
        $this->email = $data['email'];
        $this->actitud = $data['actitud'];
        $this->archivo = $data['archivo'] ?? null;
        $this->idiomas = is_array($data['idiomas']) ? $data['idiomas'] : json_decode($data['idiomas'], true);
        $this->actividades = is_array($data['actividades']) ? $data['actividades'] : json_decode($data['actividades'], true);
    }

    public function toArray() {
        return [
            ':nombre' => $this->nombre,
            ':apellido1' => $this->apellido1,
            ':apellido2' => $this->apellido2,
            ':email' => $this->email,
            ':actitud' => $this->actitud,
            ':archivo' => $this->archivo,
            ':idiomas' => json_encode($this->idiomas),
            ':actividades' => json_encode($this->actividades),
        ];
    }
}
?>
