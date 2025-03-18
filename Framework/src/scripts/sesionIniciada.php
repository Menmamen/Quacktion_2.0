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
        .btn-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .bienvenida {
            text-align: right;
            margin-top: -25px;
            margin-right: 0;
            font-size: 16px;
            color: #333;
        }

        .main-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }

        .main-buttons a {
            text-decoration: none;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <div class="container">
        <?php if ($username): ?>
            <div class="bienvenida">
                <i class="bi bi-person"></i> Bienvenido, <?php echo $username; ?>!
            </div>
        <?php endif; ?>
        <main class="form-signin m-auto">
            <div class="main-buttons">
                <a href="jugarPartida.php" class="btn btn-primary btn-lg">Iniciar Partida</a>
                <a href="invitado.php" class="btn btn-success btn-lg">Jugar como Invitado</a>
            </div>
        </main>
    </div>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
