<?php
session_start();
session_destroy();
header("Location: ../Views/inicio.php");
exit();
?>
