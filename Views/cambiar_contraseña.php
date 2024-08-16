<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nueva_contraseña = $_POST['nueva_contraseña'];

    require_once '../config/Database.php';
    $db = new Database();
    $conn = $db->getConnection();

    // Verificar el token y su expiración
    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE token = ? AND token_expira > NOW()");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->bind_result($id_usuario);
    $stmt->fetch();
    $stmt->close();

    if ($id_usuario) {
        // Actualizar la contraseña
        $hashed_password = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET contraseña = ?, token = NULL, token_expira = NULL WHERE id_usuario = ?");
        $stmt->bind_param('si', $hashed_password, $id_usuario);
        if ($stmt->execute()) {
            echo "Tu contraseña ha sido cambiada exitosamente.";
        } else {
            echo "Hubo un error al cambiar tu contraseña. Inténtalo de nuevo.";
        }
    } else {
        echo "Token inválido o expirado.";
    }
} else {
    $token = $_GET['token'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label for="nueva_contraseña">Nueva Contraseña:</label>
        <input type="password" name="nueva_contraseña" required>
        <input type="submit" value="Cambiar Contraseña">
    </form>
</body>
</html>
