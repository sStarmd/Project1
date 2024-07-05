<?php
require_once('../Controllers/UsuarioController.php');

$controller = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptar la contraseña
    $perfil = $_POST['perfil'];

    if ($controller->registrarUsuario($nombre_completo, $correo, $contraseña, $perfil)) {
        echo "Registro exitoso.";
    } else {
        echo "Error al registrar.";
    }
}
?>
