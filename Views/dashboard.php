<?php
session_start();

// Verificar si hay sesión iniciada
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../config/Database.php';
$db = new Database();
$conn = $db->getConnection();

// Obtener los ambientes
$query = "SELECT * FROM ambientes";
$result = $conn->query($query);
$ambientes = $result->fetch_all(MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Responsiva con Header</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <header>
        <div class="logo"> <img src="img/logoSena.png" alt="Logo"> </div>
        <div class="bienvenida"> <span><?php echo $_SESSION['perfil']; ?></span>
        <a href="../php/logout.php" class="boton2">Cerrar sesión</a>
        </div>
    </header>

    <main>
        <section class="seccion-izquierda">
        <h1>Bienvenid@, <?php echo $_SESSION['nombre_completo']; ?>.</h1>
      <a href="registro_entrada.php" class="boton">Registrar nueva entrada</a> 
      <a href="descargar_pdf.php" class="boton">Descargar PDF de la Semana</a>
        </section>
        
        
        
        <section class="seccion-derecha">
    
    <h2>Ambientes disponibles</h2>
    <div id="ambientes">
        <?php foreach ($ambientes as $ambiente): ?>
            <div 
                class="ambiente <?php echo $ambiente['disponible'] ? 'libre' : 'ocupado'; ?>" 
                data-id="<?php echo $ambiente['Id_ambiente']; ?>"
                onclick="toggleAmbiente(<?php echo $ambiente['Id_ambiente']; ?>)"
            >
                <?php echo $ambiente['nombre_ambiente']; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container">
        <div class="btn-float">
            <a href="https://wa.me/1234567890?text=¡Alerta%20de%20Emergencia%21%20Se%20ha%20activado%20una%20alerta%20de%20emergencia%20en%20el%20sistema%2E" target="_blank" class="btn"><i class="fab fa-github"></i>Activar Emergencia</a>
        </div>
    </div>
        </section>
    </main>

    <!-- <footer>
        <p>&copy; 2024 Mi Sitio Web</p>
    </footer> -->
    <script>
        function toggleAmbiente(id) {
            fetch('../php/toggle_ambiente.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const ambienteDiv = document.querySelector(`div[data-id='${id}']`);
                    ambienteDiv.classList.toggle('libre', data.disponible);
                    ambienteDiv.classList.toggle('ocupado', !data.disponible);
                } else {
                    alert('Error al cambiar el estado del ambiente.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>