<?php
session_start();

// Verificar si ya hay una sesión iniciada
if (isset($_SESSION['id'])) {
    header("Location: ../Views/dashboard.php");
    exit;
}

// Incluir el controlador y realizar la verificación del inicio de sesión
require_once('../Controllers/UsuarioController.php');
$controller = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Llamar al método del controlador para iniciar sesión
    $usuario = $controller->iniciarSesionUsuario($correo, $contraseña);

    if ($usuario) {
        // Iniciar sesión y establecer variables de sesión
        $_SESSION['id'] = $usuario['Id_usuario'];
        $_SESSION['nombre_completo'] = $usuario['nombre_completo'];
        $_SESSION['perfil'] = $usuario['perfil'];

        // Redirigir a dashboard.php
        header("Location: ../Views/dashboard.php");
        exit;
    } else {
        // Si las credenciales no son válidas, mostrar mensaje de error
        echo "Error al iniciar sesión.";
    }
}
?>