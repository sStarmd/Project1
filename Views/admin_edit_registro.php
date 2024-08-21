<?php
session_start();
if (!isset($_SESSION['admin_id'])) { // Verifica si el usuario es administrador
    header("Location: admin_login.php"); // Redirige al login si no está autenticado
    exit();
}

require_once '../config/Database.php';

$id = $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Actualiza el registro con los datos enviados
    $fecha_hora_entrada = $_POST['fecha_hora_entrada'];
    $nombre_completo_sale = $_POST['nombre_completo_sale'];
    $nombre_completo_entra = $_POST['nombre_completo_entra'];
    $perfil_entra = $_POST['perfil_entra'];
    $novedades = $_POST['novedades'];
    $id_usuario = $_POST['id_usuario'];
    $id_ambiente = $_POST['id_ambiente'];

    $query = "UPDATE registro_entrada SET 
        fecha_hora_entrada = ?, 
        nombre_completo_sale = ?, 
        nombre_completo_entra = ?, 
        perfil_entra = ?, 
        novedades = ?, 
        id_usuario = ?, 
        id_ambiente = ? 
        WHERE id_registro = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssii", $fecha_hora_entrada, $nombre_completo_sale, $nombre_completo_entra, $perfil_entra, $novedades, $id_usuario, $id_ambiente, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}

$query = "SELECT * FROM registro_entrada WHERE id_registro = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$registro = $result->fetch_assoc();

// Obtener usuarios y ambientes para los selects
$usuarios = $conn->query("SELECT * FROM usuarios")->fetch_all(MYSQLI_ASSOC);
$ambientes = $conn->query("SELECT * FROM ambientes")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <h1>Editar Registro de Entrada</h1>
    <form method="post" action="admin_edit_registro.php?id=<?php echo $id; ?>">
        <!-- Formulario para editar el registro -->
        <label for="fecha_hora_entrada">Fecha y Hora:</label>
        <input type="datetime-local" id="fecha_hora_entrada" name="fecha_hora_entrada" value="<?php echo date('Y-m-d\TH:i', strtotime($registro['fecha_hora_entrada'])); ?>" required>

        <label for="nombre_completo_sale">Nombre de quien Sale:</label>
        <input type="text" id="nombre_completo_sale" name="nombre_completo_sale" value="<?php echo $registro['nombre_completo_sale']; ?>" required>

        <label for="nombre_completo_entra">Nombre de quien Entra:</label>
        <input type="text" id="nombre_completo_entra" name="nombre_completo_entra" value="<?php echo $registro['nombre_completo_entra']; ?>">

        <label for="perfil_entra">Perfil:</label>
        <select id="perfil_entra" name="perfil_entra" required>
            <option value="director" <?php if ($registro['perfil_entra'] == 'director') echo 'selected'; ?>>Director</option>
            <option value="instructor" <?php if ($registro['perfil_entra'] == 'instructor') echo 'selected'; ?>>Instructor</option>
            <option value="guardas" <?php if ($registro['perfil_entra'] == 'guardas') echo 'selected'; ?>>Guardas</option>
            <option value="otros" <?php if ($registro['perfil_entra'] == 'otros') echo 'selected'; ?>>Otros</option>
        </select>

        <label for="novedades">Novedades:</label>
        <input type="text" id="novedades" name="novedades" value="<?php echo $registro['novedades']; ?>">

        <label for="id_usuario">Usuario:</label>
        <select id="id_usuario" name="id_usuario" required>
            <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo $usuario['Id_usuario']; ?>" <?php if ($usuario['Id_usuario'] == $registro['id_usuario']) echo 'selected'; ?>>
                <?php echo $usuario['nombre_completo']; ?>
            </option>
            <?php endforeach; ?>
        </select>

        <label for="id_ambiente">Ambiente:</label>
        <select id="id_ambiente" name="id_ambiente" required>
            <?php foreach ($ambientes as $ambiente): ?>
            <option value="<?php echo $ambiente['Id_ambiente']; ?>" <?php if ($ambiente['Id_ambiente'] == $registro['id_ambiente']) echo 'selected'; ?>>
                <?php echo $ambiente['nombre_ambiente']; ?>
            </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
