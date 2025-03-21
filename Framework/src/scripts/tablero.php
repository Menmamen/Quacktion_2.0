<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruleta - Quacktion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f2b2d;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .sidebar {
            background-color: #678;
            padding: 20px;
            height: 100vh;
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            border-radius: 50%;
            /* Hace que la imagen sea circular */
            margin-bottom: 20px;
        }

        .ruleta-container {
            position: relative;
            width: 525px;
            height: 525px;
        }

        .ruleta {
            width: 100%;
            height: 100%;
            transform-origin: center;
            transition: transform 3s ease-out;
        }

        .boton-girar {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 50%;
            width: 120px;
            /* Antes 80px */
            height: 120px;
            /* Antes 80px */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            /* Asegura que el texto sea proporcional */
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border: none;
        }

        .boton-girar:hover {
            background: #ddd;
        }

        #resultado {
            margin-top: 20px;
            font-size: 20px;
        }

        /* Flecha indicadora */
        .flecha {
            position: absolute;
            top: -45px;
            /* La punta apunta a la ruleta */
            left: 50%;
            transform: translateX(-50%);
            /* Flecha centrada */
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 30px solid white;
            /* Flecha invertida correctamente */
        }

        .btn {
            background-color: #F3F3F3;
        }

        #pregunta-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        #pregunta-texto {
            color: #007bff;
        }
    </style>
</head>

<body>

    <!-- Menú lateral -->
    <div class="sidebar">
        <img src="/Framework/public/assets/img/quacktion.jpg" alt="Quacktion" width="80">
        <a href="/Framework/public/main.php" class="btn btn-light my-2 rounded-5 border-dark">Inicio</a>
        <a href="./index.php" class="btn btn-light my-2 rounded-5 border-dark">Log in</a>
        <!-- <button class="btn btn-light my-2 rounded-5 border-dark">Nueva Partida</button>
        <button class="btn btn-light my-2 rounded-5 border-dark">Reiniciar Partida</button>
   -->
    </div>

    <!-- Ruleta -->
    <div class="ruleta-container">
        <div class="flecha" id="flecha"></div>
        <svg class="ruleta" id="ruleta" width="350" height="350" viewBox="-262.5 -262.5 525 525">
            <!-- Generación de las secciones con JavaScript -->
        </svg>
        <button class="boton-girar" id="boton-girar" onclick="girarRuleta()">GIRAR</button>
    </div>

    <div id="pregunta-container" class="container text-center p-4 rounded shadow-lg bg-light" style="display: none; opacity: 0; max-width: 600px; margin: auto;">
        <h2 id="pregunta-texto" class="mb-4 text-primary"></h2>
        <div id="opciones" class="d-flex flex-column gap-2"></div>
    </div>

    </div>


    <div id="resultado"></div>

    <script src="./tablero.js"></script>

</body>

</html>