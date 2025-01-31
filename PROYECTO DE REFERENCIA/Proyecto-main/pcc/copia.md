<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tec-Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pdco.css">
</head>

<body class="d-flex flex-column h-100">

    <!-- Barra de navegación principal que contiene el logo, los enlaces de navegación y el botón de traductor -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/pp/index.html">
                <img src="/png/steelwall.png" alt="Escudo basado en la ciberseguridad." height="70">
            </a><a title="Mi cuenta Pccomponentes" aria-label="Mi cuenta" data-wa-hit-type="event" data-wa-event-category="main header" data-wa-event-action="user menu click" href="/login" rel="nofollow" class="button_ghostButton__14nwxvl4 button_baseButton__14nwxvl0 button_bigButton__14nwxvla my-account-item _118qtze0"><div class="button_styledChild__14nwxvlr "><svg class="icon_defaultIcon__pltkn10 icon_bigIcon__pltkn12 _118qtze1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24"><path d="M12 12c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM20 20h-16v-1c0-3.5 3.3-6 8-6s8 2.5 8 6v1zm-13.8-2h11.7c-.6-1.8-2.8-3-5.8-3s-5.3 1.2-5.9 3z"></path></svg><span class="_118qtze3">Mi cuenta</span></div></a>

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
                <a title="Mi cuenta Pccomponentes" aria-label="Mi cuenta" data-wa-hit-type="event" data-wa-event-category="main header" data-wa-event-action="user menu click" href="/login" rel="nofollow" class="button_ghostButton__14nwxvl4 button_baseButton__14nwxvl0 button_bigButton__14nwxvla my-account-item _118qtze0"><div class="button_styledChild__14nwxvlr "><svg class="icon_defaultIcon__pltkn10 icon_bigIcon__pltkn12 _118qtze1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" enable-background="new 0 0 24 24"><path d="M12 12c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM20 20h-16v-1c0-3.5 3.3-6 8-6s8 2.5 8 6v1zm-13.8-2h11.7c-.6-1.8-2.8-3-5.8-3s-5.3 1.2-5.9 3z"></path></svg><span class="_118qtze3">Mi cuenta</span></div></a>
                <div class="dropdown">
                    <button class="btn bg-dark text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Traductor
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="/cat/pp/index.html">Catalán</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/ing/pp/index.html">Inglés</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    

    <div class="container my-5">
        <h1 class="text-center">Configurador de PC</h1>
        <form id="pcConfigForm" method="POST" action="procesar_formulario.php">
            <div class="row g-3">
            <div class="col-md-4">
    <div class="card p-3">
        <h5 class="card-title">procesador</h5>
        <select class="form-select" name="procesador" required>
            <option value="">Selecciona un procesador</option>
            <option value="">I5</option>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Modelo FROM procesador"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['Modelo'] . '</option>';
                }
            } else {
                echo '<option value="">No hay procesadores disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
        </select>
    </div>
</div>
        
    <div class="col-md-4">
    <div class="card p-3">
        <h5 class="card-title">Placa Base</h5>
        <select class="form-select" name="placa_base" required>
            <option value="">Selecciona una placa base</option>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Modelo FROM placa_base"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['Modelo'] . '</option>';
                }
            } else {
                echo '<option value="">No hay placas base disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
        </select>
    </div>
</div>

        
            <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="card-title">Tarjeta Gráfica</h5>
                        <select class="form-select" name="gpu" required>
                        <option value="">Selecciona una tarjeta grafica</option>
                        <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Modelo FROM tarjeta_grafica"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['Modelo'] . '</option>';
                }
            } else {
                echo '<option value="">No hay placas base disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
                        </select>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="card-title">Memoria RAM</h5>
                        <select class="form-select" name="ram" required>
                        <option value="">Selecciona una memoria ram</option>
                        <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Marca ,  tipoderam , Capacidad FROM memoria_ram"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' .  '">' . $fila['Marca'] . ' ' . 
                    $fila['tipoderam'] . ' ' . $fila['Capacidad'] . '</option>'; 
                }
            } else {
                echo '<option value="">No memorias ram disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
                        </select>
                    </div>
            </div>
        
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="card-title">Disco Duro</h5>
                        <select class="form-select" name="almacenamiento" required>
                            <option value="">Selecciona el tipo de de disco duro</option>
                            <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Modelo FROM disco_duro"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['Modelo'] . '</option>';
                }
            } else {
                echo '<option value="">No hay placas base disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
                        </select>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="card-title">Fuente de Alimentación</h5>
                        <select class="form-select" name="fuente" required>
                        <option value="">Selecciona una fuenta de alimentación</option>
                             
                            <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Marca, Modelo FROM fuente_alimentacion"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['Marca'] . ' ' . $fila['Modelo'] . '</option>';
                }
            } else {
                echo '<option value="">No hay placas base disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
                        </select>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="card-title">Caja</h5>
                        <select class="form-select" name="caja" required>
                        <option value="">Selecciona una caja</option>
                            <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Modelo FROM caja"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['Modelo'] . ' ' . $fila['Modelo'] . '</option>';
                }
            } else {
                echo '<option value="">No hay placas base disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
                        </select>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="card-title">Disipadores</h5>
                        <select class="form-select" name="sistema de refrigeracion" required>
                        <option value="">Selecciona un disipador</option>
                        <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'componentes');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las placas base
            $sql = "SELECT Modelo FROM refrigeracion_cpu"; // Asegúrate de usar el nombre correcto de tu tabla y columnas
            $resultado = $conexion->query($sql);

            // Generar las opciones del select
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<option value="' .  '">' . $fila['Modelo'] . '</option>'; 
                }
            } else {
                echo '<option value="">No hay placas base disponibles</option>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
                        </select>
                    </div>
            </div>
            </div>
        
            
        
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary">Guardar creacion</button>
            </div>
        </form>
    </div>    

        <!-- Pie de pagina -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
