<?php
session_start();
header('Content-Type: application/json');

require_once '../config/Database.php';

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'No está autorizado.']);
    exit;
}

// Verificar si se recibió el ID del ambiente
if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID de ambiente no proporcionado.']);
    exit;
}

$ambienteId = intval($_POST['id']);

// Conectar a la base de datos
$db = new Database();
$conn = $db->getConnection();

// Obtener el estado actual del ambiente
$query = "SELECT disponible FROM ambientes WHERE Id_ambiente = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $ambienteId);
$stmt->execute();
$stmt->bind_result($disponible);
$stmt->fetch();
$stmt->close();

if ($disponible === null) {
    echo json_encode(['success' => false, 'message' => 'Ambiente no encontrado.']);
    exit;
}

// Cambiar el estado del ambiente
$newDisponible = $disponible ? 0 : 1;
$updateQuery = "UPDATE ambientes SET disponible = ? WHERE Id_ambiente = ?";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bind_param("ii", $newDisponible, $ambienteId);
$updateSuccess = $updateStmt->execute();
$updateStmt->close();

if ($updateSuccess) {
    echo json_encode(['success' => true, 'disponible' => $newDisponible]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado del ambiente.']);
}
?>
