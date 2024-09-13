<?php
class GestorExpedientes {
    private $archivo;

    public function __construct($archivo) {
        $this->archivo = $archivo;
    }

    // Obtener todos los expedientes (o un array vacío si no hay)
    public function obtenerExpedientes() {
        if (file_exists($this->archivo)) {
            return json_decode(file_get_contents($this->archivo), true) ?: [];
        }
        return [];
    }

    // Guardar expedientes
    public function guardarExpedientes($expedientes) {
        file_put_contents($this->archivo, json_encode($expedientes, JSON_PRETTY_PRINT));
    }

    // Agregar un nuevo expediente
    public function agregarExpediente($expediente) {
        $expedientes = $this->obtenerExpedientes();
        $expedientes[] = $expediente;
        $this->guardarExpedientes($expedientes);
    }

    // Actualizar un expediente existente
    public function actualizarExpediente($id, $nuevoExpediente) {
        $expedientes = $this->obtenerExpedientes();
        foreach ($expedientes as &$expediente) {
            if ($expediente['id'] == $id) {
                $expediente = (array) $nuevoExpediente;
                break;
            }
        }
        $this->guardarExpedientes($expedientes);
    }

    // Eliminar un expediente
    public function eliminarExpediente($id) {
        $expedientes = $this->obtenerExpedientes();
        $expedientes = array_filter($expedientes, fn($expediente) => $expediente['id'] != $id);
        $this->guardarExpedientes($expedientes);
    }
}
