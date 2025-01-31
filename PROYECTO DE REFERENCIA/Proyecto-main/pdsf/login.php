<?php
// Iniciar sesión
session_start();

// Configuración de la base de datos
$servername = "127.0.0.1"; // o localhost
$username = "root"; // Usuario de MySQL
$password = ""; // Contraseña de MySQL
$dbname = "Tec-Shop"; // Nombre de la base de datos

// Variables de error
$error = "";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Verificar las credenciales en la base de datos
    $sql = "SELECT * FROM login WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        // Compara la contraseña ingresada con la almacenada (sin hash si la guardaste en texto plano)
        if ($contraseña == $row['contraseña']) {
            // Si las credenciales son correctas, guardar información en la sesión
            $_SESSION['usuario'] = $usuario;
            header("Location: bienvenido.php");  // Redirigir a la página de bienvenida
            exit();
        } else {
            // Si las credenciales son incorrectas, mostrar el mensaje de error
            $error = "Credenciales incorrectas.";
        }
    } else {
        // Si el usuario no existe, mostrar el mensaje de error
        $error = "Credenciales incorrectas.";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steel Wall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pdsf.css">
</head>
<body class="d-flex flex-column h-100">

    <!-- Barra de navegación principal que contiene el logo, los enlaces de navegación y el botón de traductor -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="png/steelwall.png" alt="Escudo basado en la ciberseguridad." height="70">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pdsf/index.html">Software</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="psn/index.html">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pds/index.html">Soporte</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn bg-dark text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Traductor
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="cat/pdsf/index.html">Catalán</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="ing/pdsf/index.html">Inglés</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="Field1" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="Field1" name="usuario">
                    </div>
                    <div class="mb-3">
                        <label for="Field2" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="Field2" name="contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </form>
               
                <!-- Mostrar el mensaje de error si las credenciales son incorrectas -->
                <?php
                if ($error) {
                    echo "<p class='text-danger mt-3'>$error</p>";
                }
                ?>
               
                <p class="mt-3"><a href="index.html">¿No tienes cuenta?</a></p>
            </div>
        </div>
    </div>

    <!-- Pie de pagina -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <hr class="border-5" class="">
                    <p>Si entras a esta página, aceptas las políticas y términos de privacidad. Todos los derechos reservados. Todas las marcas registradas pertenecen a <span class="fw-bold">Steelwall ©</span>.
                    </p>
                    <p>Redes sociales: |
                        <a href="https://www.instragram.com" target="_blank" class="fw-bold"> Instagram</a> <a href="https://www.instragram.com" target="_blank"><img class="redes" src="png/instagram.png" alt="Instagram" height="30" >
                        </a> |    
                        <a href="https://www.github.com" target="_blank" class="fw-bold"> Github</a> <a href="https://www.github.com" target="_blank"><img class="redes" src="png/github.png" alt="Github" height="30" >
                        </a> |    
                        <a href="https://www.twitter.com" target="_blank" class="fw-bold"> Twitter</a> <a href="https://www.twitter.com" target="_blank"><img class="redes" src="png/twiiter.png" alt="Twitter" height="30" >
                        </a> |    
                    </p>
                    <p>Si deseas ponerte en contacto con nosotros, puedes hacerlo de las siguientes maneras: |
                        <a href="https://acortar.link/QToXfs" target="_blank"> <span class="fw-bold">Correo:</span> Steelwall@empresa.es
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

</body>
</html>