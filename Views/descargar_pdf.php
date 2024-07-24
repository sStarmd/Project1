<?php
require_once '../libs/dompdf/autoload.inc.php';
require_once '../config/Database.php';

use Dompdf\Dompdf;

$database = new Database();
$conn = $database->getConnection();

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . $database->getConnectionError());
}

// Obtener la fecha de hace una semana
$one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));

// Consulta para obtener los registros de la última semana con el nombre del perfil
$query = "
    SELECT r.id_registro, r.fecha_hora_entrada, r.nombre_completo_sale, r.nombre_completo_entra, r.id_ambiente, r.novedades, p.nombre_perfil
    FROM registro_entrada r
    JOIN usuarios u ON r.id_usuario = u.id_usuario
    JOIN perfiles p ON u.id_perfil = p.id_perfil
    WHERE r.fecha_hora_entrada >= ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param('s', $one_week_ago);
$stmt->execute();
$result = $stmt->get_result();

// Generar contenido HTML para el PDF
$html = '<h1>Registros de Entrada de la Última Semana</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="6">';
$html .= '<tr><th>ID</th><th>Fecha y Hora</th><th>Nombre de Quien Sale</th><th>Nombre de Quien Entra</th><th>Ambiente</th><th>Perfil</th><th>Novedades</th></tr>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['id_registro'] . '</td>';
    $html .= '<td>' . $row['fecha_hora_entrada'] . '</td>';
    $html .= '<td>' . $row['nombre_completo_sale'] . '</td>';
    $html .= '<td>' . $row['nombre_completo_entra'] . '</td>';
    $html .= '<td>' . $row['id_ambiente'] . '</td>';
    $html .= '<td>' . $row['nombre_perfil'] . '</td>';
    $html .= '<td>' . $row['novedades'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

// Crear instancia de Dompdf
$dompdf = new Dompdf();

// Cargar el contenido HTML
$dompdf->loadHtml($html);

// (Opcional) Configurar el tamaño y la orientación del papel
$dompdf->setPaper('A4', 'landscape');

// Renderizar el HTML como PDF
$dompdf->render();

// Salida del PDF generado al navegador
$dompdf->stream("registro_entrada_semanal.pdf", array("Attachment" => 0));
?>
