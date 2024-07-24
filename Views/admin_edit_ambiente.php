<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

require_once '../config/Database.php';

$id = $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

$query = "SELECT * FROM ambientes WHERE Id_ambiente = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$ambiente = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $query = "UPDATE ambientes SET nombre_ambiente = ?, disponible = ? WHERE Id_ambiente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $nombre, $disponible, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ambiente</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <h1>Editar Ambiente</h1>
    <form method="post" action="admin_edit_ambiente.php?id=<?php echo $id; ?>">
        <label for="nombre">Nombre del Ambiente:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $ambiente['nombre_ambiente']; ?>" required>
        <label for="disponible">Disponible:</label>
        <input type="checkbox" id="disponible" name="disponible" <?php if ($ambiente['disponible']) echo 'checked'; ?>>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
