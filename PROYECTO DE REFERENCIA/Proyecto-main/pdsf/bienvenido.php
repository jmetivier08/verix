<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir a login.php
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>¡Hola, <?php echo $_SESSION['usuario']; ?>!</h1>
    <p>Bienvenido a la página protegida.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
