<?php
session_start();

include_once("mysql.php");
$username = "";

if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
}

$mensaje = "";
$msgClass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['codigo']) && isset($_POST['continente'])) {
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $continente = $_POST['continente'];

        $insercion = "INSERT INTO country (code, name, continent) VALUES ('$codigo', '$nombre', '$continente')";
        if (insertar($insercion)) {
            $mensaje = "Registro insertado correctamente.";
            $msgClass = "success-message";
        } else {
            $mensaje = "Error al insertar el registro.";
            $msgClass = "error-message";
        }
    } else {
        $mensaje = "No has introducido datos válidos.";
        $msgClass = "error-message";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

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

        @media (max-width: 576px) {
            .container {
                max-width: 100%;
            }
        }

        .button-container {
            margin-bottom: 20px;
        }

        .bienvenida {
            text-align: right;
            margin-top: -25px;
            margin-right: 0;
            font-size: 16px;
            color: #333;

        }

    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <div class="container">
        <div class="button-container">
            <form action="main.php">
                <button type="submit" class="btn btn-primary">Volver al menú principal</button>
            </form>
            <div class="bienvenida">
                <i class="bi bi-person"></i> Bienvenido <?php echo $username; ?>
            </div>
        </div>
        <main class="form-signin m-auto">
            <!-- Mostrar mensaje -->
            <?php if ($mensaje): ?>
                <div class="<?php echo htmlspecialchars($msgClass); ?> ">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="nuevo.php">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nombre" name="nombre">
                    <label for="floatingInput">Nombre</label>
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="codigo" name="codigo">
                    <label for="floatingInput">Código</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="continente" name="continente">
                    <label for="floatingInput">Continente</label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Insertar</button>
            </form>
        </main>
    </div>
</body>

</html>