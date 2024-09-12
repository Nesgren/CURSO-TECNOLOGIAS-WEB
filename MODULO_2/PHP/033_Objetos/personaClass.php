<?php

// Clase base Persona
class Persona {
    // Atributos privados
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fechaNac;
    private $genero;

    // Constructor de Persona
    function __construct($nombre, $apellido1, $apellido2, $fechaNac, $genero) {
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->fechaNac = $fechaNac;
        $this->genero = $genero;
    }

    // Métodos getters para obtener los atributos
    function getNombre() { return $this->nombre; }
    function getApellido1() { return $this->apellido1; }
    function getApellido2() { return $this->apellido2; }
    function getFechaNac() { return $this->fechaNac; }
    function getGenero() { return $this->genero; }

    // Método para mostrar los datos de la persona
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

// Clase derivada Usuario que extiende Persona
class Usuario extends Persona {
    // Atributos privados específicos de Usuario
    private $id;
    private $username;
    private $password;
    private $rol;

    // Constructor de Usuario
    function __construct($nombre, $apellido1, $apellido2, $fechaNac, $genero, $id, $username, $password, $rol) {
        // Llama al constructor de la clase base Persona
        parent::__construct($nombre, $apellido1, $apellido2, $fechaNac, $genero);
        // Inicializa los atributos adicionales de Usuario
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->rol = $rol;
    }

    // Métodos getters para obtener los atributos específicos de Usuario
    function getId() { return $this->id; }
    function getUsername() { return $this->username; }
    function getPassword() { return $this->password; }
    function getRol() { return $this->rol; }

    // Sobrescribe el método VerDatos para añadir datos adicionales
    function VerDatos() {
        // Llama al método VerDatos de la clase base Persona
        parent::VerDatos();
        // Añade información específica de Usuario
        echo "<div class='usuario-datos'>";
        echo "<p><strong>ID:</strong> " . htmlspecialchars($this->getId()) . "</p>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($this->getUsername()) . "</p>";
        echo "<p><strong>Rol:</strong> " . htmlspecialchars($this->getRol()) . "</p>";
        echo "</div>";
    }
}

// Crear un objeto de Usuario
$usuario = new Usuario('Franco', 'Zuccorononno', 'Sutera', '23/11/1993', 'Masculino', '123', 'franco123', 'password', 'admin');

// Mostrar los datos del usuario
$usuario->VerDatos();
?>
