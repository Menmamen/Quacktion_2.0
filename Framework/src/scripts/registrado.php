<?php
session_start();

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

$mensaje = "";
$msgClass = "";
$num_jugadores = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['num_jugadores'])) {
        $num_jugadores = intval($_POST['num_jugadores']);
        $_SESSION['num_jugadores'] = $num_jugadores;
    } elseif (isset($_POST['jugador_1'])) {
        $nombres_jugadores = [];
        for ($i = 1; $i <= $_SESSION['num_jugadores']; $i++) {
            if (isset($_POST["jugador_$i"])) {
                $nombres_jugadores[] = $_POST["jugador_$i"];
            }
        }
        $_SESSION['nombres_jugadores'] = $nombres_jugadores;
        header("Location: main.php");
        exit();
    } else {
        $mensaje = "Por favor, ingrese el número de jugadores.";
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
    <title>Bienvenido</title>
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
        <h1 class="h3 mb-3 fw-normal">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>!</h1>
        <!-- Mostrar mensaje -->
        <?php if ($mensaje): ?>
            <div class="<?php echo htmlspecialchars($msgClass); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <?php if ($num_jugadores == 0): ?>
                <h1 class="h3 mb-3 fw-normal">Introduce el número de jugadores</h1>

                <div class="form-floating">
                    <input type="number" class="form-control" id="num_jugadores" name="num_jugadores" placeholder="Número de Jugadores" required>
                    <label for="num_jugadores">Número de Jugadores</label>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit">Siguiente</button>
            <?php else: ?>
                <h1 class="h3 mb-3 fw-normal">Introduce los nombres de los jugadores</h1>

                <?php for ($i = 1; $i <= $num_jugadores; $i++): ?>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="jugador_<?php echo $i; ?>" name="jugador_<?php echo $i; ?>" placeholder="Nombre del Jugador <?php echo $i; ?>" required>
                        <label for="jugador_<?php echo $i; ?>">Nombre del Jugador <?php echo $i; ?></label>
                    </div>
                <?php endfor; ?>

                <button class="btn btn-primary w-100 py-2" type="submit">Crear Partida</button>
            <?php endif; ?>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
        </form>
    </main>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>