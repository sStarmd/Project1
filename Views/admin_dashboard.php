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
    <link rel="stylesheet" href="css/admin-dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

     <header class="admin-header">
        <div class="logo">
            <img src="img/logoSena.png" alt="Logo">
        </div>
        <h1>Panel de Administración</h1>
        <a href="admin_logout.php" class="btn btn-outline-secondary">Cerrar sesión</a>
    </header>


<br>
<div class="btn-2">
    <a href="../php/export_excel.php" class="btn">Descargar Historial de Registros</a>
</div> <br>


    <div class="btn-2">
        <h2>Ambientes</h2>
        <a  href="admin_add_ambiente.php">Agregar Ambiente</a>
    </div>
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
            <a class="btn btn-outline-success" href="admin_edit_ambiente.php?id=<?php echo $ambiente['Id_ambiente']; ?>">Editar</a>
            <a class="btn btn-outline-danger" href="admin_delete_ambiente.php?id=<?php echo $ambiente['Id_ambiente']; ?>">Eliminar</a>

            </td>
        </tr>
        <?php endforeach; ?>
    </table>

  
<!-- 
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
                <a class="btn-edit"  href="admin_edit_registro.php?id=<?php echo $registro['id_registro']; ?>">Editar</a>
                <a class="btn-delete"  href="admin_delete_registro.php?id=<?php echo $registro['id_registro']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table> -->

    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="img/logoSena.png" alt="Logo SENA">
                </div>
                <div class="footer-links">
                    <a href="https://www.sena.edu.co/es-co/Paginas/default.aspx" target="_blank">Inicio</a>
                    <a href="https://www.sena.edu.co/es-co/ciudadano/Paginas/default.aspx" target="_blank">Ciudadano</a>
                    <a href="https://www.sena.edu.co/es-co/empresarios/Paginas/default.aspx" target="_blank">Empresarios</a>
                    <a href="https://www.sena.edu.co/es-co/centros/Paginas/default.aspx" target="_blank">Centros</a>
                </div>
                <div class="footer-social">
                    <a href="https://www.facebook.com/SENAColombia" target="_blank">Facebook</a>
                    <a href="https://twitter.com/SENAComunica" target="_blank">Twitter</a>
                    <a href="https://www.instagram.com/senacomunica/" target="_blank">Instagram</a>
                </div>
                <div class="footer-contact">
                    <p>Cl. 2 #13 - 3, Villeta, Cundinamarca
                    SENA, CDAE Villeta, dirección</p>
                    <p>Teléfono: </p>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>
