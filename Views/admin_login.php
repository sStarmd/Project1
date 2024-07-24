<?php
session_start();
require_once '../config/Database.php';

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
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <div class="adminLogin"><form method="post" action="admin_login.php">
        <h2>Login Administrador</h2>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <button type="submit">Login</button>
    </form></div>
</body>
</html>
