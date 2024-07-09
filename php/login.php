<?php
session_start();

// Verificar si ya hay una sesión iniciada
if (isset($_SESSION['id'])) {
    header("Location: ../Views/dashboard.php");
    exit;
}

require_once '../Controllers/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $usuarioController = new UsuarioController();
    if ($usuarioController->iniciarSesion($correo, $contraseña)) {
        header("Location: ../Views/dashboard.php");
        exit();
    } else {
        echo "Error al iniciar sesión.";
    }
}
?>