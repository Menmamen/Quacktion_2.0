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
        .success-message {
            background-color: #d4edda;
            color: rgba(36, 173, 68, 0.49);
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .error-message {
            background-color: #f8d7da;
            color: rgba(135, 28, 38, 0.47);
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin m-auto">
        <!-- Mostrar mensaje -->
        <?php if ($mensaje): ?>
            <div class="<?php echo htmlspecialchars($msgClass); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <h1 class="h3 mb-3 fw-normal">Crear una cuenta</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de Usuario" required>
                <label for="nombre_usuario">Nombre de Usuario</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                <label for="password">Contraseña</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" required>
                <label for="correo">Correo Electrónico</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Crear Cuenta</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
        </form>
    </main>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>