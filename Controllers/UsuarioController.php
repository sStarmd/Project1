<?php
require_once('../config/Database.php');
require_once('../models/Usuario.php');

class UsuarioController {
    private $usuario;
    private $db;

    public function __construct() {
        $this->db = Database::getInstance(); // Obtener instancia de la clase Database
        $this->usuario = new Usuario($this->db->getConnection()); // Pasar la conexión MySQLi al modelo Usuario
    }

    public function registrarUsuario($nombre_completo, $correo, $contraseña, $perfil) {
        $this->usuario->nombre_completo = $nombre_completo;
        $this->usuario->correo = $correo;
        $this->usuario->contraseña = $contraseña;
        $this->usuario->perfil = $perfil;

        if ($this->usuario->registrar()) {
            return true; // Registro exitoso
        } else {
            return false; // Error al registrar usuario
        }
    }

    public function iniciarSesionUsuario($correo, $contraseña) {
        $this->usuario->correo = $correo;

        $usuario = $this->usuario->iniciarSesion();

        if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            // Iniciar sesión exitoso
            return $usuario;
        } else {
            // Error al iniciar sesión
            return null;
        }
    }
}
?>
