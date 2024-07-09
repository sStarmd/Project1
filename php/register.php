<?php
require_once '../Controllers/UsuarioController.php';

$controller = new UsuarioController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $id_perfil = $_POST['perfil'];

    $resultado = $controller->registrarUsuario($nombre_completo, $correo, $contraseña, $id_perfil);

    if ($resultado) {
        echo "<script>
                alert('Registro exitoso. Será redirigido al inicio de sesión.');
                window.location.href = '../index.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al registrar el usuario. Inténtelo de nuevo.');
                window.history.back();
              </script>";
    }
}
?>
