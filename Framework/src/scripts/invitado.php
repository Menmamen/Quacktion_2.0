<?php
session_start();
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
    <title>Crear Partida</title>
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
    </style>
</head>

<body>
    <div class="container-login">
        <img src="/Framework/public/assets/img/goose-head-v36-patch-streetwear-600nw-2201843891.webp" class="icon-user" alt="Icono de Usuario">

        <?php if ($mensaje): ?>
            <div class="<?php echo htmlspecialchars($msgClass); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php if ($num_jugadores == 0): ?>
                <h1>Introduce el número de jugadores</h1>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="num_jugadores" name="num_jugadores" placeholder="Número de Jugadores" required>
                </div>

                <button class="btn btn-custom btn-primary" type="submit">Siguiente</button>
            <?php else: ?>
                <h1>Introduce los nombres de los jugadores</h1>

                <?php for ($i = 1; $i <= $num_jugadores; $i++): ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="jugador_<?php echo $i; ?>" name="jugador_<?php echo $i; ?>" placeholder="Nombre del Jugador <?php echo $i; ?>" required>
                    </div>
                <?php endfor; ?>

                <button class="btn btn-custom btn-primary" type="submit">Crear Partida</button>
            <?php endif; ?>

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
