<?php
session_start();
$mensaje = "";
$msgClass = "";

require_once 'mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre_usuario']) && isset($_POST['password']) && isset($_POST['correo'])) {
        $con = mysqli_connect($domain, $usuario, $pword, $database, $port);
        if (!$con) {
            die("Error en la conexión: " . mysqli_connect_error());
        }

        $nombre_usuario = mysqli_real_escape_string($con, $_POST['nombre_usuario']);
        $password = password_hash(mysqli_real_escape_string($con, $_POST['password']), PASSWORD_BCRYPT);
        $correo = mysqli_real_escape_string($con, $_POST['correo']);

        $sql = "INSERT INTO Usuario (nombre_usuario, password, correo) VALUES ('$nombre_usuario', '$password', '$correo')";

        if (insertar($sql)) {
            $mensaje = "Cuenta creada exitosamente.";
            $msgClass = "success-message";
        } else {
            $mensaje = "Error al crear la cuenta.";
            $msgClass = "error-message";
        }

        mysqli_close($con);
    } else {
        $mensaje = "Por favor, complete todos los campos.";
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
    <title>Crear Cuenta</title>
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #102F31;
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

        .form-floating {
            display: flex;
            width: 100%;
            /* Aseguramos que el contenedor ocupe todo el ancho */
            align-items: center;
            margin-bottom: 15px;
        }

        .form-floating input {
            width: 100%;
            height: 45px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 0 10px;
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
    </style>
</head>

<body>
    <a href="/Framework/public/main.php" class="btn-flotante">
        <img src="/Framework/public/assets/img/quacktion.jpg" alt="Ir a main.php" title="Volver a Inicio">
    </a>
    <div class="container-login">
        <!-- Icono centrado arriba -->
        <img src="/Framework/public/assets/img/goose-head-v36-patch-streetwear-600nw-2201843891.webp" class="icon-user" alt="Icono de Usuario">

        <?php if ($mensaje): ?>
            <div class="<?php echo htmlspecialchars($msgClass); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <h1>Crear Cuenta</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de Usuario" required>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" required>
            </div>

            <button class="btn btn-custom btn-primary" type="submit">Crear Cuenta</button>
        </form>

        <form method="get" action="index.php">
            <button class="btn btn-custom btn-secondary mt-2" type="submit">Volver al login</button>
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
</body>

</html>