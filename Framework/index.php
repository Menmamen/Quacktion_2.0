<?php
session_start();
$mensaje = "";
$msgClass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Aquí deberías validar el usuario y la contraseña
        // Si la validación es correcta, almacena el nombre de usuario en la sesión
        $_SESSION['username'] = $_POST['username'];
        // Redirige a main.php después de iniciar sesión
        header("Location: main.php");
        exit();
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
    <title>Login DAW</title>
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
        <form method="post" action="index.php">
            <img class="mb-4 mx-auto d-block" src="/img/racoon-pedro.gif" alt="" width="85" height="85">
            <h1 class="h3 mb-3 fw-normal">Inicia sesión para continuar</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario">
                <label for="floatingInput">Usuario</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Recuérdame
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Iniciar sesión</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
        </form>
    </main>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>