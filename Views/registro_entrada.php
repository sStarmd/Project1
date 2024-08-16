<?php
session_start();

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['nombre_completo'])) {
    header("Location: ../Views/index.php");
    exit;
}

$nombre_usuario = $_SESSION['nombre_completo']; // Obtén el nombre del usuario desde la sesión

// Conexión a la base de datos
require_once '../config/Database.php'; // Asegúrate de que la ruta sea correcta
$db = new Database();
$conn = $db->getConnection();

// Consulta para obtener los ambientes disponibles
$query = "SELECT Id_ambiente, nombre_ambiente FROM ambientes WHERE disponible = 1";
$result = $conn->query($query);

$ambientes = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $ambientes[] = $row;
    }
} else {
    echo "Error al obtener los ambientes: " . $conn->error;
}


require_once '../config/Database.php';

// Obtener el perfil del usuario
$db = new Database();
$conn = $db->getConnection();
$id_usuario = $_SESSION['id'];

$query = "SELECT id_perfil FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($id_perfil);
$stmt->fetch();
$stmt->close();
$conn->close();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Registro de Entrada</title>
</head>
<body>
<a href="javascript:history.back()" class="back-arrow">Atrás</a>
</a>
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Registro de Entrada</h2>
                <p>Por favor completa los datos para registrar una nueva entrada.</p>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <form action="../php/guardar_registro.php" method="post" class="form form-register">
                    <label for="nombre_completo_entra">
                        <i class="bx bx-user"></i>
                        <input
                          placeholder="Nombre de quien entra"
                          type="text"
                          id="nombre_completo_entra"
                          name="nombre_completo_entra"
                          value="<?php echo htmlspecialchars($nombre_usuario); ?>" 
                          readonly 
                          required
                        />
                    </label>

                    <label for="nombre_completo_sale">
                        <i class="bx bx-user"></i>
                        <input
                          placeholder="Nombre de quien sale"
                          type="text"
                          id="nombre_completo_sale"
                          name="nombre_completo_sale"
                         
                        />
                    </label>

                    <label for="ambiente" class="ambiente-label">
                        <i class="bx bxs-school"></i>
                        Ambiente
                        <select id="ambiente" name="ambiente" required>
                          <?php foreach ($ambientes as $ambiente): ?>
                              <option value="<?php echo $ambiente['Id_ambiente']; ?>">
                                  <?php echo htmlspecialchars($ambiente['nombre_ambiente']); ?>
                              </option>
                          <?php endforeach; ?>
                        </select>
                    </label>

                    <label for="novedades">
                        <i class="bx bx-message-rounded"></i>
                        <input
                          placeholder="Novedades"
                          type="text"
                          id="novedades"
                          name="novedades"
                        />
                    </label>
                    <input type="hidden" name="id_perfil" value="<?php echo htmlspecialchars($id_perfil); ?>">

                    <input type="submit" value="Registrar Entrada">
                </form>
            </div>
        </div>
    </div>
    <script src="js/movimiento.js"></script>
</body>
</html>
