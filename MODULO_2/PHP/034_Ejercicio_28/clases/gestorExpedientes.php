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

    public function agregarExpediente(Expediente $expediente) {
        $expedientes = $this->obtenerExpedientes();
        $expedientes[] = $this->expedienteToArray($expediente);
        $this->guardarExpedientes($expedientes);
    }

    public function obtenerExpedientePorId($id) {
        $expedientes = $this->obtenerExpedientes();
        foreach ($expedientes as $expediente) {
            if ($expediente['id'] == $id) {
                return $this->arrayToExpediente($expediente);
            }
        }
        return null;
    }

    public function actualizarExpediente($id, Expediente $nuevoExpediente) {
        $expedientes = $this->obtenerExpedientes();
        foreach ($expedientes as &$expediente) {
            if ($expediente['id'] == $id) {
                $expediente = $this->expedienteToArray($nuevoExpediente);
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

    private function expedienteToArray(Expediente $expediente) {
        return [
            'id' => $expediente->getId(),
            'nombre' => $expediente->getNombre(),
            'apellido1' => $expediente->getApellido1(),
            'apellido2' => $expediente->getApellido2(),
            'email' => $expediente->getEmail(),
            'actividades' => $expediente->getActividades(),
            'actitud' => $expediente->getActitud(),
            'idiomas' => $expediente->getIdiomas(),
            'archivo' => $expediente->getArchivo()
        ];
    }

    private function arrayToExpediente(array $data) {
        return new Expediente(
            $data['id'],
            $data['nombre'],
            $data['apellido1'],
            $data['apellido2'],
            $data['email'],
            $data['actividades'],
            $data['actitud'],
            $data['idiomas'],
            $data['archivo']
        );
    }
}
?>
