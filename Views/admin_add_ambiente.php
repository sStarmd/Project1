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

    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Ambiente</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <h1>Agregar Ambiente</h1>
    <form method="post" action="admin_add_ambiente.php">
        <label for="nombre">Nombre del Ambiente:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="disponible">Disponible:</label>
        <input type="checkbox" id="disponible" name="disponible">
        <button type="submit">Agregar</button>
    </form>
</body>
</html>
