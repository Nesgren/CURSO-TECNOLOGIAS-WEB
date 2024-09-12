<?php
require_once 'personaClass.php';

class Usuario extends Persona {
    public $id;
    //getters y setters
    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }
    public $username;
    function getUsername() {
        return $this->username;
    }
    function setUsername($username) {
        $this->username = $username;
    }
    public $password;
    function getPassword() {
        return $this->password;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    public $rol;
    function getRol() {
        return $this->rol;
    }
    function setRol($rol) {
        $this->rol = $rol;
    }
}

$Usuario = new Usuario('Franco', 'Zuccorononno', 'Sutera', '23/11/1993', 'Masculino', '123', 'admin');