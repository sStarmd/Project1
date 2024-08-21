<?php
session_start();
require_once '../config/Database.php'; // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Conectar a la base de datos
    $db = new Database();
    $conn = $db->getConnection();

    // Verificar las credenciales del administrador
    $query = "SELECT * FROM usuarios WHERE correo = ? AND es_admin = 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($contraseña, $user['contraseña'])) {
            $_SESSION['admin_id'] = $user['Id_usuario'];
            $_SESSION['admin_correo'] = $user['correo'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Correo no encontrado o no tienes permisos de administrador.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login Administrador</title>
        <link rel="stylesheet" href="css/admin-login.css">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    </head>
    <body>
    <div class="container-form admin-login">
        <div class="information">
            <div class="info-childs">
                <h2>Administrador</h2>
                <p>Debes iniciar sesión para acceder al panel de administración.</p>
            </div>
        </div>
        <!-- formulario para iniciar sesion como administrador -->
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Inicia sesion como Administrador</h2>
                <form method="post" action="admin_login.php" class="form">
                    <?php if (isset($error)) echo "<p>$error</p>"; ?>
                    <label for="correo">Correo:
                        <input type="email" id="correo" name="correo" required>
                    </label>
                    <label for="contraseña"> Contraseña:
                        <input type="password" id="contraseña" name="contraseña" required>
                    </label>
                    <div class="btn">
                        <input type="submit" value="Entrar">
                        <!-- Enlace a inicio -->
                        <a href="inicio.php">Volver al Inicio</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>
