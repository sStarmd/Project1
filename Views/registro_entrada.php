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
    <title>Registro de Entrada</title>
</head>
<body>
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
                          <option value="1">Sala de reuniones</option>
                          <option value="2">Aula 1</option>
                          <option value="3">Aula 2</option>
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

                    <input type="submit" value="Registrar Entrada">
                </form>
            </div>
        </div>
    </div>
    <script src="js/movimiento.js"></script>
</body>
</html>
