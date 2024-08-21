<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];

    // Generar un token único para la recuperación de contraseña
    $token = bin2hex(random_bytes(50));

    require_once '../config/Database.php';
    $db = new Database();
    $conn = $db->getConnection();

    // Guardar el token y la fecha de expiración en la base de datos
    $stmt = $conn->prepare("UPDATE usuarios SET token = ?, token_expira = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE correo = ?");
    $stmt->bind_param('ss', $token, $correo);

    if ($stmt->execute()) {
        // Enviar el correo con el enlace de recuperación
        require '../vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'in-v3.mailjet.com'; // Cambiar por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = '59365fee844ceeefbb57eb6e83f660bc'; //API
            $mail->Password = '0f3cab6abeb56096d4db086bf70f11d3'; // CLAVE SECRETA
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatario
            $mail->setFrom('moi7548@gmail.com', 'Starmd');
            $mail->addAddress($correo);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperar contraseña';
            $mail->Body = "Para recuperar tu contraseña, haz clic en el siguiente enlace: <a href='http://localhost/Proyecto_version_final/Views/cambiar_contrase%C3%B1a.php?token=$token'>Recuperar contraseña</a>";
            $mail->send();
            echo "Revisa tu correo para continuar con la recuperación de la contraseña.";
        } catch (Exception $e) {
            echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No se encontró una cuenta asociada a este correo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
</head>
<body>
    <form action="" method="post">
        <label for="correo">Introduce tu correo electrónico:</label>
        <input type="email" name="correo" required>
        <input type="submit" value="Enviar correo de recuperación">
    </form>
</body>
</html>