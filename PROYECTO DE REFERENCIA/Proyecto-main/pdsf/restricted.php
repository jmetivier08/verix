<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");  // Si no está autenticado, redirigir a login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pdsf.css">
    <title>Página Protegida</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h1>
    <p>Esta es una página protegida que solo puedes ver después de iniciar sesión.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
