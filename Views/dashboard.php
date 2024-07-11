<?php
session_start();

// Verificar si hay sesión iniciada
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre_completo']; ?>!</h1>
    <p>Perfil: <?php echo $_SESSION['perfil']; ?></p>
    <a href="../php/logout.php">Cerrar sesión</a>
    <a href="../Views/registro_entrada.php">Registrar nueva entrada</a>
</body>
</html>
