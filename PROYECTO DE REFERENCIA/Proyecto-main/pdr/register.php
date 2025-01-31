<?php
// Configuración de la base de datos
$servername = "127.0.0.1"; // o localhost
$username = "root"; // Usuario de MySQL
$password = ""; // Contraseña de MySQL
$dbname ="Tec-Shop"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$confirmar_contraseña = $_POST['confirmar_contraseña'];

// Validar formato del usuario
if (!preg_match('/^[a-zA-Z0-9@._-]+$/', $usuario)) {
    echo "El usuario contiene caracteres no permitidos. Solo se aceptan letras, números y '@', '.', '_', '-'.";
    exit;
}

// Validar longitud de la contraseña
if (strlen($contraseña) < 6) {
    echo "La contraseña debe tener al menos 6 caracteres.";
    exit;
}

// Verificar que las contraseñas coincidan
if ($contraseña !== $confirmar_contraseña) {
    echo "<h3>Las contraseñas no coinciden. Por favor, vuelve a intentarlo.</h3>";
    echo "<a href='/pp/index.html'>Regresar al formulario</a>";
    exit;
}

// Verificar si el usuario ya existe
$sql_check = "SELECT * FROM login WHERE usuario = ?";
$stmt_check = $conn->prepare($sql_check);

if (!$stmt_check) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt_check->bind_param("s", $usuario);
$stmt_check->execute();

$result = $stmt_check->get_result();

if (!$result) {
    die("Error en la ejecución de la consulta: " . $conn->error);
}

// Verificar si se encontró el usuario
if ($result->num_rows > 0) {
    echo "<h3>El usuario ya existe. Intenta con otro nombre.</h3>";
    echo "<a href='/pp/index.html'>Regresar al formulario</a>";
    exit;
} else {
    echo "<h3>El usuario no existe, procediendo con el registro...</h3>";
}

// No aplicar hash a la contraseña, se guarda tal cual
$contraseña_guardada = $contraseña;  // Usar la contraseña tal cual, sin aplicar hash

// Insertar el usuario en la base de datos
$sql = "INSERT INTO login (usuario, contraseña) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $contraseña_guardada);

if ($stmt->execute()) {
    echo "<h1>Registro exitoso. ¡Bienvenido, $usuario!</h1>";
    echo "<a href='/pp/index.html'>Volver al inicio</a>";
} else {
    echo "Error: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
