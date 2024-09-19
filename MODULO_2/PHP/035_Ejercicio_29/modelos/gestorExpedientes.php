<?php
require_once 'expediente.php';

class GestorExpedientes {
    private $archivo;

    public function __construct($archivo) {
        $this->archivo = $archivo;
    }

    public function obtenerExpedientes() {
        if (file_exists($this->archivo)) {
            $data = json_decode(file_get_contents($this->archivo), true) ?: [];
            
            // Convertir arrays a objetos Expediente
            return array_map(function($item) {
                return new Expediente(
                    $item['id'],
                    $item['nombre'],
                    $item['apellido1'],
                    $item['apellido2'],
                    $item['email'],
                    $item['actividades'],
                    $item['actitud'],
                    $item['idiomas'],
                    $item['archivo']
                );
            }, $data);
        }
        return [];
    }

    public function guardarExpedientes($expedientes) {
        $data = array_map(function($expediente) {
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
