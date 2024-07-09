<?php
require_once '../config/Database.php';
require_once '../models/Usuario.php';

class UsuarioController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    public function registrarUsuario($nombre_completo, $correo, $contraseña, $id_perfil) {
        $this->usuario->nombre_completo = $nombre_completo;
        $this->usuario->correo = $correo;
        $this->usuario->contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
        $this->usuario->id_perfil = $id_perfil;

        return $this->usuario->registrar();
    }

    public function iniciarSesion($correo, $contraseña) {
        $this->usuario->correo = $correo;
        $datosUsuario = $this->usuario->iniciarSesion();

        if ($datosUsuario && password_verify($contraseña, $datosUsuario['contraseña'])) {
            session_start();
            $_SESSION['id'] = $datosUsuario['Id_usuario'];
            $_SESSION['nombre_completo'] = $datosUsuario['nombre_completo'];
            $_SESSION['perfil'] = $datosUsuario['nombre_perfil'];
            return true;
        } else {
            return false;
        }
    }
}
?>
