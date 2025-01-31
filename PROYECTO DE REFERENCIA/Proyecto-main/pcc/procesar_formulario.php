<?php
// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'configurador_pc');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $procesador = $_POST['procesador'];
    $placa_base = $_POST['placa_base'];
    $gpu = $_POST['gpu'];
    $ram = $_POST['ram'];
    $almacenamiento = $_POST['almacenamiento'];
    $fuente = $_POST['fuente'];
    $caja = $_POST['caja'];
    $sistema_refrigeracion = $_POST['sistema de refrigeracion'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO componentes_pc (procesador, placa_base, tarjeta_grafica, ram, almacenamiento, fuente_alimentacion, caja, sistema_refrigeracion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssss", $procesador, $placa_base, $gpu, $ram, $almacenamiento, $fuente, $caja, $sistema_refrigeracion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos guardados exitosamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
}
?>
