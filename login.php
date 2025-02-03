<?php
session_start();

// Simulación de credenciales correctas (puedes cambiar esto por una base de datos)
$usuario_valido = "admin";
$contraseña_valida = "12345";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["username"];
    $contraseña = $_POST["password"];

    if ($usuario === $usuario_valido && $contraseña === $contraseña_valida) {
        $_SESSION["usuario"] = $usuario;
        header("Location: dashboard.php"); // Redirige a una página de bienvenida
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.html';</script>";
    }
}
?>
