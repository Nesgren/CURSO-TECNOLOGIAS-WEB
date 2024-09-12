<?php

class Persona {
    // Atributos
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fechaNac;
    private $genero;

    // Constructor
    function __construct($nombre, $apellido1, $apellido2, $fechaNac, $genero) {
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->fechaNac = $fechaNac;
        $this->genero = $genero;
    }

    // Métodos getters
    function getNombre() { return $this->nombre; }
    function getApellido1() { return $this->apellido1; }
    function getApellido2() { return $this->apellido2; }
    function getFechaNac() { return $this->fechaNac; }
    function getGenero() { return $this->genero; }

    function VerDatos() {
        echo "<div class='persona-datos'>";
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($this->getNombre()) . "</p>";
        echo "<p><strong>Apellido 1:</strong> " . htmlspecialchars($this->getApellido1()) . "</p>";
        echo "<p><strong>Apellido 2:</strong> " . htmlspecialchars($this->getApellido2()) . "</p>";
        echo "<p><strong>Fecha de Nacimiento:</strong> " . htmlspecialchars($this->getFechaNac()) . "</p>";
        echo "<p><strong>Genero:</strong> " . htmlspecialchars($this->getGenero()) . "</p>";
        echo "</div>";
    }
}

class Usuario extends Persona {
    private $id;
    private $username;
    private $password;
    private $rol;

    // Constructor
    function __construct($nombre, $apellido1, $apellido2, $fechaNac, $genero, $id, $username, $password, $rol) {
        parent::__construct($nombre, $apellido1, $apellido2, $fechaNac, $genero);
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->rol = $rol;
    }

    // Métodos getters
    function getId() { return $this->id; }
    function getUsername() { return $this->username; }
    function getPassword() { return $this->password; }
    function getRol() { return $this->rol; }

    // Sobrescribe el método VerDatos
    function VerDatos() {
        parent::VerDatos();
        echo "<div class='usuario-datos'>";
        echo "<p><strong>ID:</strong> " . htmlspecialchars($this->getId()) . "</p>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($this->getUsername()) . "</p>";
        echo "<p><strong>Rol:</strong> " . htmlspecialchars($this->getRol()) . "</p>";
        echo "</div>";
    }
}

// Crear un objeto de Usuario
$usuario = new Usuario('Franco', 'Zuccorononno', 'Sutera', '23/11/1993', 'Masculino', '123', 'franco123', 'password', 'admin');

// Mostrar datos
$usuario->VerDatos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .persona-datos, .usuario-datos {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            margin: 5px 0;
            color: #555;
        }
        strong {
            color: #222;
        }
    </style>
</head>
<body>
    <h1>Información del Usuario</h1>
</body>
</html>
