<?php
session_start();

// Verificar si hay sesión iniciada
if (!isset($_SESSION['id'])) {
    header("Location: ../Views/index.php");
    exit;
}

require_once '../config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo_entra = $_POST['nombre_completo_entra'];
    $nombre_completo_sale = $_POST['nombre_completo_sale'];
    $id_ambiente = $_POST['ambiente'];
    $novedades = $_POST['novedades'];
    $id_perfil = $_POST['id_perfil']; // Agregar esta línea
    $id_usuario = $_SESSION['id'];

    // Crear una instancia de la clase Database
    $db = new Database();
    $conn = $db->getConnection();

    // Verificar la conexión
    if ($conn) {
        $stmt = $conn->prepare("INSERT INTO registro_entrada (nombre_completo_entra, nombre_completo_sale, id_ambiente, novedades, id_usuario, id_perfil) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisis", $nombre_completo_entra, $nombre_completo_sale, $id_ambiente, $novedades, $id_usuario, $id_perfil);
    
        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'Registro de entrada exitoso.',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../Views/dashboard.php';
                            }
                        });
                    };
                  </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al registrar la entrada.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../Views/dashboard.php';
                            }
                        });
                    };
                  </script>";
        }
    
        $stmt->close();
        $conn->close();
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Error de conexión',
                        text: 'No se pudo conectar a la base de datos.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../Views/dashboard.php';
                        }
                    });
                };
              </script>";
    }
    
}
?>