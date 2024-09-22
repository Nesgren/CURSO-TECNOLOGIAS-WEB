<?php
class NombresModel {
    public function __construct() {
        if (!isset($_SESSION['nombres'])) {
            $_SESSION['nombres'] = [];
        }
    }

    // Obtener todos los nombres
    public function getNombres() {
        return $_SESSION['nombres'];
    }

    // Agregar un nombre a la lista
    public function addNombre($nombre) {
        $nombre = htmlspecialchars(trim($nombre));
        if (!empty($nombre)) {
            $_SESSION['nombres'][] = $nombre;
        }
    }

    // Eliminar un nombre de la lista por su índice
    public function deleteNombre($index) {
        if (isset($_SESSION['nombres'][$index])) {
            unset($_SESSION['nombres'][$index]);
            $_SESSION['nombres'] = array_values($_SESSION['nombres']); // Re-indexa el array
        }
    }
}
