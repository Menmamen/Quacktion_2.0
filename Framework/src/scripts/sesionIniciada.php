<?php
session_start();
include_once("mysql.php");
$username = "";

if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Carmen Montalvo Luque">
    <title>Página Principal</title>
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
            flex-direction: column;
        }

        .container-main {
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

        .bienvenida {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #1E6063;
        }

        .main-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
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
            text-decoration: none;
        }

        .btn-primary {
            background: #1E6063;
        }

        .btn-success {
            background: #205E5F;
        }

        .btn-custom:hover {
            filter: brightness(1.2);
        }

        .icon-user {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 50%;
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
    <a href="/Framework/public/main.php" class="btn-flotante">
        <img src="/Framework/public/assets/img/quacktion.jpg" alt="Ir a main.php" title="Volver a Inicio">
    </a>
    <div class="container-main">
        <img src="/Framework/public/assets/img/goose-head-v36-patch-streetwear-600nw-2201843891.webp" class="icon-user" alt="Icono de Usuario">
        <?php if ($username): ?>
            <div class="bienvenida">
                <i class="bi bi-person"></i> Bienvenido, <?php echo $username; ?>!
            </div>
        <?php endif; ?>
        <h1>Menú Principal</h1>
        <div class="main-buttons">
            <a href="../scripts/tablero.php" class="btn btn-custom btn-primary">Iniciar Partida</a>
            <a href="invitado.php" class="btn btn-custom btn-success">Jugar como Invitado</a>
        </div>
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
