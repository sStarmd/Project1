<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

require_once '../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $db = new Database();
    $conn = $db->getConnection();

    $query = "INSERT INTO ambientes (nombre_ambiente, disponible) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $nombre, $disponible);
    $stmt->execute();
// Redirige al panel de administración
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Ambiente</title>
    <link rel="stylesheet" href="css/admin-add-ambiente.css">
</head>
<body>
    <div class="container-form">
        <div class="information">
            <div class="info-childs">
                <h2>Información del Ambiente</h2>
                <p>Ingrese los detalles del nuevo ambiente en el formulario.</p>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Agregar Ambiente</h2>
                <form method="post" action="admin_add_ambiente.php">
                    <div class="form">
                        <label  for="nombre">
                            <i class="fas fa-building"></i>
                            <input type="text" id="nombre" name="nombre" placeholder="Nombre del Ambiente" required>
                        </label>
                        <label class="input-2" for="disponible">
                            Disponible
                            <input type="checkbox" id="disponible" name="disponible">
                        </label>
                    </div>
                    <div class="btn">
                        <input type="submit" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
