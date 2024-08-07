<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Conectar a la base de datos
require_once '../config/Database.php'; // Asegúrate de que la ruta sea correcta
$db = new Database();
$conn = $db->getConnection();

// Obtener los registros de entrada con nombres de ambientes
$query = "
    SELECT 
        r.id_registro, 
        r.fecha_hora_entrada, 
        r.nombre_completo_entra, 
        r.nombre_completo_sale, 
        a.nombre_ambiente, 
        r.novedades
    FROM 
        registro_entrada r
    JOIN 
        ambientes a ON r.id_ambiente = a.Id_ambiente
";
$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Registros de Entrada');

// Encabezados de las columnas
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Fecha y Hora');
$sheet->setCellValue('C1', 'Nombre de quien entra');
$sheet->setCellValue('D1', 'Nombre de quien sale');
$sheet->setCellValue('E1', 'Ambiente');
$sheet->setCellValue('F1', 'Novedades');

// Añadir los datos de los registros de entrada
$rowNumber = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNumber, $row['id_registro']);
    $sheet->setCellValue('B' . $rowNumber, $row['fecha_hora_entrada']);
    $sheet->setCellValue('C' . $rowNumber, $row['nombre_completo_entra']);
    $sheet->setCellValue('D' . $rowNumber, $row['nombre_completo_sale']);
    $sheet->setCellValue('E' . $rowNumber, $row['nombre_ambiente']); // Mostrar el nombre del ambiente
    $sheet->setCellValue('F' . $rowNumber, $row['novedades']);
    $rowNumber++;
}

// Crear un archivo Excel
$writer = new Xlsx($spreadsheet);
$filename = 'Registros_de_Entrada_' . date('Ymd_His') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
