<?php
class GestorExpedientes {
    private $archivo;

    public function __construct($archivo) {
        $this->archivo = $archivo;
    }

    public function obtenerExpedientes() {
        if (file_exists($this->archivo)) {
            $data = json_decode(file_get_contents($this->archivo), true) ?: [];
            return array_map([Expediente::class, 'fromArray'], $data);
        }
        return [];
    }

    public function guardarExpedientes($expedientes) {
        $data = array_map(function($expediente) {
            return $expediente->toArray();
        }, $expedientes);
        file_put_contents($this->archivo, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function agregarExpediente($expediente) {
        $expedientes = $this->obtenerExpedientes();
        $expedientes[] = $expediente;
        $this->guardarExpedientes($expedientes);
    }

    public function obtenerExpedientePorId($id) {
        $expedientes = $this->obtenerExpedientes();
        foreach ($expedientes as $expediente) {
            if ($expediente->getId() == $id) {
                return $expediente;
            }
        }
        return null;
    }

    public function actualizarExpediente($id, $nuevoExpediente) {
        $expedientes = $this->obtenerExpedientes();
        foreach ($expedientes as &$expediente) {
            if ($expediente->getId() == $id) {
                $expediente = $nuevoExpediente;
                break;
            }
        }
        $this->guardarExpedientes($expedientes);
    }

    public function eliminarExpediente($id) {
        $expedientes = $this->obtenerExpedientes();
        $expedientes = array_filter($expedientes, function($expediente) use ($id) {
            return $expediente->getId() != $id;
        });
        $this->guardarExpedientes($expedientes);
    }
}
?>
