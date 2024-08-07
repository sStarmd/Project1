<?php
require_once '../libs/dompdf/autoload.inc.php';
require_once '../config/Database.php';

use Dompdf\Dompdf;

$database = new Database();
$conn = $database->getConnection();

// Obtener la fecha de hace una semana
$one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));

// Consulta para obtener los registros de la última semana con el nombre del ambiente
$query = "
    SELECT re.id_registro, re.fecha_hora_entrada, re.nombre_completo_sale, re.nombre_completo_entra, a.nombre_ambiente, re.novedades
    FROM registro_entrada re
    JOIN ambientes a ON re.id_ambiente = a.id_ambiente
    WHERE re.fecha_hora_entrada >= '$one_week_ago'
";
$result = $conn->query($query);

// Generar contenido HTML para el PDF
$html = '<h1>Registros de Entrada de la Última Semana</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="6">';
$html .= '<tr><th>ID</th><th>Fecha y Hora</th><th>Nombre de Quien Sale</th><th>Nombre de Quien Entra</th><th>Ambiente</th><th>Novedades</th></tr>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['id_registro'] . '</td>';
    $html .= '<td>' . $row['fecha_hora_entrada'] . '</td>';
    $html .= '<td>' . $row['nombre_completo_sale'] . '</td>';
    $html .= '<td>' . $row['nombre_completo_entra'] . '</td>';
    $html .= '<td>' . $row['nombre_ambiente'] . '</td>'; // Mostrar el nombre del ambiente
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
