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

$query = "DELETE FROM ambientes WHERE Id_ambiente = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin_dashboard.php");
exit();
?>