<?php
require_once '../Controllers/UsuarioController.php';

$controller = new UsuarioController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $id_perfil = $_POST['perfil'];

    $resultado = $controller->registrarUsuario($nombre_completo, $correo, $contraseña, $id_perfil);

    // Incluir SweetAlert2
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<style>
        @media (max-width: 600px) {
            .swal2-popup {
                width: 90% !important;
                font-size: 1.2rem !important;
            }
        }
    </style>";

    if ($resultado) {
        echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Registro exitoso. Será redirigido al inicio de sesión.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            popup: 'swal2-popup-custom'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../index.php'; // Redirige al inicio de sesión
                        }
                    });
                };
              </script>";
    } else {
        echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al registrar el usuario. Inténtelo de nuevo.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.history.back(); // Regresa a la página anterior
                        }
                    });
                };
              </script>";
    }
}
?>
