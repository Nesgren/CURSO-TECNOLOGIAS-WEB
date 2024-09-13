<?php
class GestorExpedientes {
    private $archivo;

    public function __construct($archivo) {
        $this->archivo = $archivo;
    }

    public function obtenerExpedientes() {
        if (file_exists($this->archivo)) {
            return json_decode(file_get_contents($this->archivo), true) ?: [];
        }
        return [];
    }

    public function guardarExpedientes($expedientes) {
        file_put_contents($this->archivo, json_encode($expedientes, JSON_PRETTY_PRINT));
    }

    public function agregarExpediente($expediente) {
        $expedientes = $this->obtenerExpedientes();
        $expedientes[] = $expediente;
        $this->guardarExpedientes($expedientes);
    }

    public function obtenerExpedientePorId($id) {
        $expedientes = $this->obtenerExpedientes();
        foreach ($expedientes as $expediente) {
            if ($expediente['id'] == $id) {
                return $expediente;
            }
        }
        return null;
    }

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

    public function eliminarExpediente($id) {
        $expedientes = $this->obtenerExpedientes();
        $expedientes = array_filter($expedientes, fn($expediente) => $expediente['id'] != $id);
        $this->guardarExpedientes($expedientes);
    }
}
?>
