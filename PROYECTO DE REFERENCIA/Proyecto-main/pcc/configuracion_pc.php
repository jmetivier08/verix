<?php
// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'componentes');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Función para obtener los modelos de una tabla
function obtenerModelos($conexion, $tabla) {
    // Definir el nombre de la columna según la tabla
    $columna = 'Modelo'; // Por defecto, buscamos 'Modelo'
    
    // Cambiar la columna dependiendo de la tabla
    if ($tabla == 'memoria_ram') {
        $columna = 'Capacidad';
    }

    // Construir la consulta SQL
    $sql = "SELECT $columna FROM $tabla";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $modelos = [];
        while ($row = $result->fetch_assoc()) {
            $modelos[] = $row[$columna];
        }
        return $modelos;
    }
    return [];
}

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $procesador = $_POST['procesador'];
    $placa_base = $_POST['placa_base'];
    $tarjeta_grafica = $_POST['tarjeta_grafica'];
    $ram = $_POST['ram'];
    $almacenamiento = $_POST['almacenamiento'];
    $fuente_alimentacion = $_POST['fuente_alimentacion'];
    $caja = $_POST['caja'];
    $sistema_refrigeracion = $_POST['sistema_refrigeracion'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO configuraciones_pc (procesador, placa_base, tarjeta_grafica, ram, almacenamiento, fuente_alimentacion, caja, sistema_refrigeracion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssss", $procesador, $placa_base, $tarjeta_grafica, $ram, $almacenamiento, $fuente_alimentacion, $caja, $sistema_refrigeracion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos guardados exitosamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la sentencia
    $stmt->close();
}

// Obtener los modelos de cada tabla
$modelosProcesador = obtenerModelos($conexion, 'procesador');
$modelosPlacaBase = obtenerModelos($conexion, 'placa_base');
$modelosTarjetaGrafica = obtenerModelos($conexion, 'tarjeta_grafica');
$modelosRAM = obtenerModelos($conexion, 'memoria_ram');
$modelosAlmacenamiento = obtenerModelos($conexion, 'disco_duro');
$modelosFuenteAlimentacion = obtenerModelos($conexion, 'fuente_alimentacion');
$modelosCaja = obtenerModelos($conexion, 'caja');
$modelosRefrigeracion = obtenerModelos($conexion, 'refrigeracion_cpu');

// Cerrar la conexión al final
$conexion->close();
?>




<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/pp/index.html">
                <img src="/png/steelwall.png" alt="Escudo basado en la ciberseguridad." height="70">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/pp/index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pdc/index.html">Componentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/psn/index.html ">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pds/index.html">Soporte</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn bg-dark text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Traductor
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="/cat/pds/index.html">Catalán</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/ing/pds/index.html">Inglés</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configura tu PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 15px;
        }
        .question-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            padding: 15px;
            margin: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-width: 200px;
        }
        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Configura tu PC</h1>
        <form method="post" action="">
            <div class="grid-layout">
                <!-- Procesador -->
                <div class="question-card">
                    <label for="procesador">Selecciona el procesador:</label>
                    <select name="procesador" id="procesador" class="form-select" required>
                        <?php foreach ($modelosProcesador as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Placa base -->
                <div class="question-card">
                    <label for="placa_base">Selecciona la placa base:</label>
                    <select name="placa_base" id="placa_base" class="form-select" required>
                        <?php foreach ($modelosPlacaBase as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tarjeta gráfica -->
                <div class="question-card">
                    <label for="tarjeta_grafica">Selecciona la tarjeta gráfica:</label>
                    <select name="tarjeta_grafica" id="tarjeta_grafica" class="form-select" required>
                        <?php foreach ($modelosTarjetaGrafica as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- RAM -->
                <div class="question-card">
                    <label for="ram">Selecciona la RAM:</label>
                    <select name="ram" id="ram" class="form-select" required>
                        <?php foreach ($modelosRAM as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Almacenamiento -->
                <div class="question-card">
                    <label for="almacenamiento">Selecciona el almacenamiento:</label>
                    <select name="almacenamiento" id="almacenamiento" class="form-select" required>
                        <?php foreach ($modelosAlmacenamiento as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Fuente de alimentación -->
                <div class="question-card">
                    <label for="fuente_alimentacion">Selecciona la fuente de alimentación:</label>
                    <select name="fuente_alimentacion" id="fuente_alimentacion" class="form-select" required>
                        <?php foreach ($modelosFuenteAlimentacion as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Caja -->
                <div class="question-card">
                    <label for="caja">Selecciona la caja:</label>
                    <select name="caja" id="caja" class="form-select" required>
                        <?php foreach ($modelosCaja as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Refrigeración -->
                <div class="question-card">
                    <label for="sistema_refrigeracion">Selecciona el sistema de refrigeración:</label>
                    <select name="sistema_refrigeracion" id="sistema_refrigeracion" class="form-select" required>
                        <?php foreach ($modelosRefrigeracion as $modelo): ?>
                            <option value="<?php echo $modelo; ?>"><?php echo $modelo; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-custom px-5">Guardar</button>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="footer mt-auto py-3 bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <hr class="border-5" class="">
                    <p>Si entras a esta página, aceptas las políticas y términos de privacidad. Todos los derechos reservados. Todas las marcas registradas pertenecen a <span class="fw-bold">Tec-Shop ©</span>.
                    </p>
                    <p>Redes sociales: |
                        <a href="https://www.instragram.com" target="_blank" class="fw-bold"> Instagram</a> <a href="https://www.instragram.com" target="_blank"><img class="redes" src="/png/instagram.png" alt="Instagram" height="30" >
                        </a> |    
                        <a href="https://www.github.com" target="_blank" class="fw-bold"> Github</a> <a href="https://www.github.com" target="_blank"><img class="redes" src="/png/github.png" alt="Github" height="30" >
                        </a> |    
                        <a href="https://www.twitter.com" target="_blank" class="fw-bold"> Twitter</a> <a href="https://www.twitter.com" target="_blank"><img class="redes" src="/png/twiiter.png" alt="Twitter" height="30" >
                        </a> |    
                    </p>
                    <p>Si deseas ponerte en contacto con nosotros, puedes hacerlo de las siguientes maneras: |
                        <a href="https://acortar.link/QToXfs" target="_blank"> <span class="fw-bold">Correo:</span> Tec-Shop@empresa.es
                        </a> |
                        <a href="tel:+34933819005" target="_blank"> <span class="fw-bold">Teléfono:</span> 933 81 90 05
                        </a> |
                        <a href="https://acortar.link/rLKgQT" target="_blank"> <span class="fw-bold">Dirección:</span> Av. d'Eduard Maristany, 59, 08930 Sant Adrià de Besòs, Barcelona
                        </a> |
                    </p>
                    <hr class="border-5">
                </div>
            </div>
        </div>
    </footer>
</html>
