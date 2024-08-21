<?php
session_start(); // Inicia o reanuda la sesión actual
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Termina la sesión actual
header("Location: admin_login.php"); // Redirige al usuario a la página de inicio de sesión de administrador
exit();  // Finaliza la ejecución del script
?>
