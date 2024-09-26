<?php
require_once 'models/GestorExpedientes.php';

class ExpedienteController {
    private $gestor;

    public function __construct() {
        $this->gestor = new GestorExpedientes();
    }

    public function index() {
        $expedientes = $this->gestor->obtenerExpedientes();
        require_once '../views/expedientes/index.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $expediente = new Expediente([
                'nombre' => $_POST['nombre'],
                'apellido1' => $_POST['apellido1'],
                'apellido2' => $_POST['apellido2'],
                'email' => $_POST['email'],
                'actitud' => $_POST['actitud'],
                'idiomas' => json_encode($_POST['idiomas']),
                'actividades' => json_encode($_POST['actividad']),
                'archivo' => $this->manejarArchivoSubido()
            ]);

            $this->gestor->crearExpediente($expediente);
            header('Location: index.php');
        } else {
            require_once '../views/expedientes/crear.php';
        }
    }

    public function editar($id) {
        $expediente = $this->gestor->obtenerExpedientePorId($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $expediente = new Expediente([
                'id' => $id,
                'nombre' => $_POST['nombre'],
                'apellido1' => $_POST['apellido1'],
                'apellido2' => $_POST['apellido2'],
                'email' => $_POST['email'],
                'actitud' => $_POST['actitud'],
                'idiomas' => json_encode($_POST['idiomas']),
                'actividades' => json_encode($_POST['actividad']),
                'archivo' => $this->manejarArchivoSubido()
            ]);

            $this->gestor->actualizarExpediente($expediente);
            header('Location: index.php');
        } else {
            require_once '../views/expedientes/editar.php';
        }
    }

    public function eliminar($id) {
        $this->gestor->eliminarExpediente($id);
        header('Location: index.php');
    }

    private function manejarArchivoSubido() {
        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = basename($_FILES['uploadedFile']['name']);
            $rutaArchivo = "../uploads/" . $nombreArchivo;

            if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $rutaArchivo)) {
                return $nombreArchivo;
            }
        }
        return null;
    }
}
?>
