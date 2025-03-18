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
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            min-height: 100vh;
            /* Mantiene el footer pegado abajo */
            overflow-x: hidden;
        }

        .container {
            flex: 1;
            /* Permite que el contenido se expanda y el footer quede abajo */
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        #logo {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        #logo img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        #cuerpo {
            display: flex;
            grid-template-columns: 40% 20% 40%;
            gap: 25px;
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }

        #botones {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            width: 100%;
            color: white;
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

        #botones a {
            display: inline-block;
            font-size: 18px;
            padding: 12px 25px;
            width: 100%;
            max-width: 250px;
            text-align: center;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            border: none;
        }

        #invitados {
            background: linear-gradient(145deg, #1E6063, #14494B);
            color: white;
        }

        #salir {
            background: linear-gradient(145deg, #205E5F, #163F40);
            color: white;
        }

        /* Efecto al pasar el cursor */
        #botones a:hover {
            transform: translateY(-3px);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3);
            filter: brightness(1.1);
        }

        /* Efecto al hacer clic */
        #botones a:active {
            transform: translateY(1px);
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($username): ?>
            <div class="bienvenida">
                <i class="bi bi-person"></i> Bienvenido <?php echo $username; ?>
            </div>
        <?php endif; ?>

        <div id="logo">
            <img src="../../public/assets/img/quacktion.jpg" alt="logo">
        </div>

        <div id="cuerpo">
            <div id="botones">
                <a href="../../public/index.php" id="invitados">Iniciar Sesión</a>
                <a href="/Framework/src/scripts/crearCuenta.php" id="salir">Jugar como Invitado</a>
            </div>
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