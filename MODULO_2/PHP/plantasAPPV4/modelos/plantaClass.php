<?php
class Planta {
    // Propiedades privadas
    private $nombre_cientifico;
    private $nombre_comun;
    private $descripcion;
    private $id_ubicacion;
    private $stock;

    // Constructor
    public function __construct($nombre_cientifico, $nombre_comun, $descripcion, $id_ubicacion, $stock) {
        $this->nombre_cientifico = $nombre_cientifico;
        $this->nombre_comun = $nombre_comun;
        $this->descripcion = $descripcion;
        $this->id_ubicacion = $id_ubicacion;
        $this->stock = $stock;
    }

    // Getters
    public function getNombreCientifico() {
        return $this->nombre_cientifico;
    }

    public function getNombreComun() {
        return $this->nombre_comun;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIdUbicacion() {
        return $this->id_ubicacion;
    }

    public function getStock() {
        return $this->stock;
    }

    // Setters
    public function setNombreCientifico($nombre_cientifico) {
        $this->nombre_cientifico = $nombre_cientifico;
    }

    public function setNombreComun($nombre_comun) {
        $this->nombre_comun = $nombre_comun;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIdUbicacion($id_ubicacion) {
        $this->id_ubicacion = $id_ubicacion;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }
}
?>
