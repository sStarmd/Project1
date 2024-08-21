<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Iniciar Sesión</title>
</head>
<body>
    <!-- Formulario de inicio de sesión -->
     <!-- Elemento decorativo de fondo -->
<div class="fondo"></div>
<!-- Formulario de inicio de sesión -->
    <div class="container-form login">
        <div class="information">
            <div class="info-childs">
                <h2>¡Hola nuevamente!</h2>
                <p>Para iniciar sesión necesitas tener una cuenta.</p>
                <!-- boton que lo dirige al formulario para registrarse -->
                <input type="button" value="Registrarse" id="sign-up" /> <br> <br>
                <!-- boton que lo dirige al inicio de sesion del administrador -->
                <a href="admin_login.php" class="admin-link">Entrar como administrador</a>
            </div>
        </div>
        <!-- Sección del formulario para iniciar sesión -->
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <form action="../php/login.php" class="form form-login" method="post">
                    <label for="correo">
                        <i class="bx bx-envelope"></i>
                        <input type="email" placeholder="Correo Electrónico" id="correo" name="correo" required />
                    </label>
                    <label for="contraseña">
                        <i class="bx bx-lock-open"></i>
                        <input type="password" placeholder="Contraseña" id="contraseña" name="contraseña" required />
                    </label>
                    <a href="recuperar_contraseña.php" class="admin-link">Recuperar contraseña</a>
                    <input type="submit" value="Iniciar Sesión" />
                    <?php if ($error): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <!-- Formulario de registro -->
    <div class="container-form register hide">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenidos</h2>
                <p>Para unirte por favor Inicia Sesión con tus datos</p>
                <input type="button" value="Iniciar Sesión" id="sign-in" />
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crea una nueva cuenta</h2>
                <!-- Formulario que envía los datos de registro a register.php -->
                <form action="../php/register.php" class="form form-register" method="post">
                    <!-- Campo de entrada para el nombre completo -->
                    <label for="nombre_completo">
                        <i class="bx bx-user"></i>
                        <input placeholder="Nombre Completo" type="text" id="nombre_completo" name="nombre_completo" required />
                    </label>
                    <!-- Campo de entrada para el correo electrónico -->
                    <label for="correo">
                        <i class="bx bx-envelope"></i>
                        <input type="email" placeholder="Correo Electrónico" id="correo" name="correo" required />
                    </label>
                     <!-- Campo de entrada para la contraseña -->
                    <label for="contraseña">
                        <i class="bx bx-lock-open"></i>
                        <input type="password" placeholder="Contraseña" id="contraseña" name="contraseña" required />
                    </label>
                    <!-- Campo de selección para elegir el perfil del usuario -->
                    <label for="perfil" class="perfil-label">
                        <i class="bx bx-group"></i>
                        Perfil
                        <select id="perfil" name="perfil" required>
                          <option value="1">Director</option>
                          <option value="2">Instructor</option>
                          <option value="3">Guardas</option>
                          <option value="4">Otros</option>
                      </select>
                    </label>
                    <!-- Botón para enviar el formulario de registro -->
                    <input type="submit" value="Registrarse" />
                </form>
            </div>
        </div>
    </div>
    <script src="js/movimiento.js"></script>
</body>
</html>
