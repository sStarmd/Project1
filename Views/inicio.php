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
    <div class="container-form register">
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
                <form action="../php/register.php" class="form form-register" method="post">
                    <label for="nombre_completo">
                        <i class="bx bx-user"></i>
                        <input placeholder="Nombre Completo" type="text" id="nombre_completo" name="nombre_completo" required />
                    </label>
                    <label for="correo">
                        <i class="bx bx-envelope"></i>
                        <input type="email" placeholder="Correo Electrónico" id="correo" name="correo" required />
                    </label>
                    <label for="contraseña">
                        <i class="bx bx-lock-open"></i>
                        <input type="password" placeholder="Contraseña" id="contraseña" name="contraseña" required />
                    </label>
                    <label for="perfil" class="perfil-label">
                        <i class="bx bx-group"></i>
                        Perfil
                        <select id="perfil" name="perfil" required>
                          <option value="director">Director</option>
                          <option value="instructor">Instructor</option>
                          <option value="seladores">Seladores</option>
                          <option value="otros">Otros</option>
                      </select>
                    </label>
                    <input type="submit" value="Registrarse" />
                </form>
            </div>
        </div>
    </div>
    <div class="container-form login hide">
        <div class="information">
            <div class="info-childs">
                <h2>¡Hola nuevamente!</h2>
                <p>Para iniciar seccion necesitas tener una cuenta.</p>
                <input type="button" value="Registrarse" id="sign-up" />
            </div>
        </div>
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
                    <input type="submit" value="Iniciar Sesión"/>
                </form>
            </div>
        </div>
    </div>
    <script src="js/movimiento.js"></script>
</body>
</html>
