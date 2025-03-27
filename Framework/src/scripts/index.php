<?php
session_start();
$mensaje = "";
$msgClass = "";

require_once 'mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $con = mysqli_connect($domain, $usuario, $pword, $database, $port);
        if (!$con) {
            die("Error en la conexión: " . mysqli_connect_error());
        }

        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM Usuario WHERE nombre_usuario = '$username'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header("Location: /Framework/src/scripts/sesionIniciada.php");
                exit();
            } else {
                $mensaje = "Contraseña incorrecta.";
                $msgClass = "error-message";
            }
        } else {
            $mensaje = "Nombre de usuario no encontrado.";
            $msgClass = "error-message";
        }

        mysqli_close($con);
    } else {
        $mensaje = "Por favor, ingrese el nombre de usuario y la contraseña.";
        $msgClass = "error-message";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Carmen Montalvo Luque">
    <title>Login Quacktion</title>
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: rgba(16, 47, 49, 0.9) url("../../public/assets/img/geese-removebg-preview.png") repeat;
            background-size: 150px;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container-login {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #102F31;
        }

        .form-group {
            display: flex;
            width: 100%;
            /* Aseguramos que el contenedor ocupe todo el ancho */
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            height: 45px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 0 10px;
        }

        .form-control {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #1E6063;
            outline: none;
            box-shadow: 0 0 5px rgba(30, 96, 99, 0.5);
        }

        .form-floating .form-control {
            border-radius: 10px;
            padding-left: 15px;
            height: 25px;
        }

        .form-floating>label {
            font-size: 0.95rem;
            font-weight: bold;
            color: #1E6063;
        }

        .form-check {
            display: flex;
            justify-content: right;
            margin-right: 2px;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .btn-custom {
            width: 75%;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
            border: none;
            text-align: center;
            color: white;
        }

        .btn-primary {
            background: #1E6063;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .btn-secondary {
            background: #205E5F;
            margin-bottom: 20px;
        }

        .btn-custom:hover {
            filter: brightness(1.2);
        }

        .error-message,
        .success-message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
        }

        .error-message {
            background: rgba(201, 67, 67, 0.7);
            color: white;
        }

        .success-message {
            background: rgba(67, 201, 67, 0.7);
            color: white;
        }

        .text-body-secondary {
            color: rgba(0, 0, 0, 0.6);
        }

        .icon-user {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 50%;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        footer div {
            color: white;
            font-size: 15px;
        }

        .btn-flotante {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 9999;
            background-color: transparent;
            border: none;
        }

        .btn-flotante img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Estilos para centrar completamente la ventana modal */
        .modal-overlay {
            display: none;
            /* Debe estar oculto por defecto */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            /* Esto NO debe estar aquí, se activará con JS */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Contenido centrado del modal */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 320px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Contenedor de iconos */
        #icon-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 15px;
        }

        /* Imágenes de selección de icono */
        .icon-preview {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .icon-preview:hover {
            transform: scale(1.2);
        }

        /* Botón "Cerrar" con mismo estilo que "Cambiar Icono" */
        .btn-gray {
            background-color: #7a7a7a;
            /* Gris medio */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            transition: background 0.3s ease-in-out;
        }

        .btn-gray:hover {
            background-color: #5a5a5a;
            /* Gris oscuro */
            cursor: pointer;
        }

        .icon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <a href="/Framework/public/main.php" class="btn-flotante">
        <img src="/Framework/public/assets/img/quacktion.jpg" alt="Ir a main.php" title="Volver a Inicio">
    </a>
    <div class="container-login">
        <div class="icon-container">
            <img id="icon-user" src="/Framework/public/assets/img/goose-head-v36-patch-streetwear-600nw-2201843891.webp" class="icon-user" alt="Icono de Usuario">
            <button id="btn-change-icon" class="btn btn-gray">Cambiar Icono</button>
        </div>

        <div id="icon-modal" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <h2>Selecciona un Icono</h2>
                <div id="icon-preview-container"></div>
                <button id="btn-close-modal" class="btn-gray">Cerrar</button>
            </div>
        </div>

        <?php if ($mensaje): ?>
            <div class="<?php echo htmlspecialchars($msgClass); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            <h1>Iniciar Sesión</h1>

            <div class="form-group mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario" required>
            </div>

            <div class="form-group mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="remember">
                <label class="form-check-label" for="remember">Recuérdame</label>
            </div>

            <button class="btn btn-custom btn-primary" type="submit">Iniciar sesión</button>
        </form>

        <form method="get" action="/Framework/src/scripts/crearCuenta.php">
            <button class="btn btn-custom btn-secondary mt-2" type="submit">Crear Cuenta</button>
        </form>

        <p class="mt-4 text-body-secondary">&copy; 2025 Quacktion</p>
    </div>
    <footer id="pie">
        <div>Contacto</div>
        <div>|</div>
        <div>Política de privacidad</div>
        <div>|</div>
        <div>Ajustes</div>
        <div>|</div>
        <div>Quacktion 2025</div>
    </footer>

    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./scriptIconos.js"></script>

</body>

</html>