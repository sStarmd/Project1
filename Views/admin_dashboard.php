<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

require_once '../config/Database.php';

// Conectar a la base de datos
$db = new Database();
$conn = $db->getConnection();

// Obtener los ambientes
$query = "SELECT * FROM ambientes";
$result = $conn->query($query);
$ambientes = [];
while ($row = $result->fetch_assoc()) {
    $ambientes[] = $row;
}

// Obtener registros de entrada
$query = "SELECT * FROM registro_entrada";
$result = $conn->query($query);
$registros = [];
while ($row = $result->fetch_assoc()) {
    $registros[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <h1>Panel de Administración</h1>
    <a href="admin_logout.php">Cerrar sesión</a>

    <h2>Ambientes</h2>
    <a href="admin_add_ambiente.php">Agregar Ambiente</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($ambientes as $ambiente): ?>
        <tr>
            <td><?php echo $ambiente['Id_ambiente']; ?></td>
            <td><?php echo $ambiente['nombre_ambiente']; ?></td>
            <td><?php echo $ambiente['disponible'] ? 'Sí' : 'No'; ?></td>
            <td>
                <a href="admin_edit_ambiente.php?id=<?php echo $ambiente['Id_ambiente']; ?>">Editar</a>
                <a href="admin_delete_ambiente.php?id=<?php echo $ambiente['Id_ambiente']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Registros de Entrada</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha y Hora</th>
            <th>Nombre de quien sale</th>
            <th>Ambiente</th>
            <th>Novedades</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($registros as $registro): ?>
        <tr>
            <td><?php echo $registro['id_registro']; ?></td>
            <td><?php echo $registro['fecha_hora_entrada']; ?></td>
            <td><?php echo $registro['nombre_completo_sale']; ?></td>
            <td><?php echo $registro['id_ambiente']; ?></td>
            <td><?php echo $registro['novedades']; ?></td>
            <td>
                <a href="admin_edit_registro.php?id=<?php echo $registro['id_registro']; ?>">Editar</a>
                <a href="admin_delete_registro.php?id=<?php echo $registro['id_registro']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
