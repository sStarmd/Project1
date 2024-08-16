<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$database = new Database();
$conn = $database->getConnection();

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . $database->getConnectionError());
}

// Consulta para obtener todos los registros de la tabla registro_entrada
$query = "
    SELECT r.id_registro, r.fecha_hora_entrada, r.nombre_completo_sale, r.nombre_completo_entra, r.id_ambiente, r.novedades, p.nombre_perfil
    FROM registro_entrada r
    JOIN usuarios u ON r.id_usuario = u.id_usuario
    JOIN perfiles p ON u.id_perfil = p.id_perfil
";

$result = $conn->query($query);

// Crear un nuevo documento de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados de la hoja de cálculo
$sheet->setCellValue('A1', 'ID Registro');
$sheet->setCellValue('B1', 'Fecha y Hora de Entrada');
$sheet->setCellValue('C1', 'Nombre de Quien Sale');
$sheet->setCellValue('D1', 'Nombre de Quien Entra');
$sheet->setCellValue('E1', 'Ambiente');
$sheet->setCellValue('F1', 'Perfil');
$sheet->setCellValue('G1', 'Novedades');

// Rellenar la hoja de cálculo con datos de la base de datos
$rowNumber = 2; // Empezamos en la fila 2 porque la 1 es de encabezado
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNumber, $row['id_registro']);
    $sheet->setCellValue('B' . $rowNumber, $row['fecha_hora_entrada']);
    $sheet->setCellValue('C' . $rowNumber, $row['nombre_completo_sale']);
    $sheet->setCellValue('D' . $rowNumber, $row['nombre_completo_entra']);
    $sheet->setCellValue('E' . $rowNumber, $row['id_ambiente']);
    $sheet->setCellValue('F' . $rowNumber, $row['nombre_perfil']);
    $sheet->setCellValue('G' . $rowNumber, $row['novedades']);
    $rowNumber++;
}

// Establecer encabezado HTTP para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="historial_registros.xlsx"');
header('Cache-Control: max-age=0');

// Crear el archivo Excel y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
