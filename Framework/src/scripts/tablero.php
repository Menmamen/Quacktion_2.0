<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruleta - Quacktion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bagel+Fat+One&display=swap" rel="stylesheet">

    <style>
        body {
            background: rgba(16, 47, 49, 0.9) url("/Framework/public/assets/img/geese-removebg-preview.png") repeat;
            background-size: 300px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Estilo general para el sidebar */
        .sidebar {
            background-color: rgba(255, 255, 255, 0.3);
            padding: 2vh;
            height: 100vh;
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
            /* Transición para cambios suaves */
        }

        /* Aumentar el tamaño cuando el sidebar está visible */
        .sidebar:not(.hidden) {
            width: 20vw;
            /* Usamos un valor relativo (anchura del 25% de la pantalla) */
        }

        /* Estilo de los elementos dentro del sidebar */
        .sidebar img {
            border-radius: 50%;
            margin-bottom: 2vh;
            /* Espaciado en vh */
            transition: all 0.3s ease;
            width: 8vh;
            /* Tamaño relativo de la imagen */
        }

        .sidebar a {
            font-size: 2vh;
            /* Tamaño relativo para el texto */
            padding: 2vh 3vh;
            /* Medidas relativas para padding */
            transition: all 0.3s ease;
        }

        /* Al hacer visible el sidebar, aumentar el tamaño de los elementos */
        .sidebar:not(.hidden) img {
            width: 20vh;
            /* Aumenta el tamaño de las imágenes */
        }

        .sidebar:not(.hidden) a {
            font-size: 3vh;
            /* Aumenta el tamaño del texto */
            padding: 1vh 3vh;
            /* Aumenta el padding */
        }

        /* Para ocultar la barra lateral */
        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .ruleta-container {
            position: relative;
            width: 525px;
            height: 525px;
            margin-top: 20px;
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
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
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

        .flecha {
            position: absolute;
            top: -45px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 30px solid white;
        }

        .btn {
            background-color: rgb(236, 235, 228);
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

        /* Contenedor de la miniruleta */
        #mini-ruleta-container {
            position: fixed;
            top: 10px;
            right: 10px;
            width: 250px;
            height: 250px;
            text-align: center;
        }

        /* Miniruleta */
        #mini-ruleta {
            position: relative;
            width: 250px;
            height: 250px;
            z-index: 2;
            /* La miniruleta debe tener un z-index más alto para estar encima del nombre */
        }

        /* Imagen superpuesta sobre la miniruleta */
        #mini-ruleta-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            z-index: 3;
            /* La imagen debe estar encima de la miniruleta */
        }

        #nombre-mini-ruleta {
            font-family: 'Bagel Fat One', sans-serif;
            position: absolute;
            top: 210px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 25px;
            font-weight: lighter;
            width: 100%;
            text-align: center;
            z-index: 4;
            text-transform: uppercase; 
        }


        /* Para ocultar la barra lateral */
        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .toggle-btn {
            background-color: rgb(236, 235, 228) !important;
            position: fixed;
            top: 0px;
            left: 0px;
            z-index: 1000;
            background: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Estilos para la ventana emergente */
        .ventana-emergente {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 1);
            /* Fondo más claro y opaco */
            color: #333;
            padding: 40px;
            border-radius: 10px;
            display: none;
            /* Ocultar por defecto */
            z-index: 1001;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            width: 60%;
            /* Ventana más grande */
            max-width: 600px;
            text-align: center;
        }

        /* Estilos para la imagen y la corona */
        .imagen-corona {
            position: relative;
            margin-bottom: 20px;
        }

        .imagen-corona img {
            width: 150px;
            /* Tamaño de la imagen de la miniruleta */
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            position: relative;
            z-index: 1;
        }

        .corona-imagen {
            position: absolute;
            top: -20px;
            /* Ajuste vertical para colocar la corona sobre la imagen */
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            /* Tamaño de la corona más pequeño */
            height: auto;
            /* Mantener las proporciones de la corona */
            border: none;
            /* Eliminar borde */
            z-index: 2;
            /* Asegura que la corona esté encima de la imagen */
        }

        /* Estilos para la imagen de la miniruleta */
        #imagen-corona {
            width: 150px;
            /* Tamaño de la imagen de la miniruleta */
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            position: relative;
            z-index: 1;
            /* Asegura que la imagen de la miniruleta esté debajo de la corona */
        }

        /* Estilos para la imagen de la corona */
        #corona {
            position: absolute;
            top: -20px;
            /* Ajuste vertical para colocar la corona sobre la imagen */
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            /* Tamaño de la corona más pequeño */
            height: auto;
            /* Mantener las proporciones de la corona */
            border: none;
            /* Eliminar borde */
            z-index: 2;
            /* Asegura que la corona esté encima de la imagen */
        }

        /* Estilo para el título */
        .contenido-ventana h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Estilo para el texto */
        .contenido-ventana p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        /* Estilo para los enlaces */
        .contenido-ventana a {
            margin: 10px;
            padding: 12px 25px;
            font-size: 18px;
            text-decoration: none;
            display: inline-block;
            background-color: rgba(15, 43, 45, 0.6);
            border-radius: 5px;
            color: #000;
        }

        .contenido-ventana a:hover {
            background-color: #ddd;
        }

    </style>
</head>

<body>
    <button class="btn btn-light toggle-btn" onclick="toggleSidebar()">☰</button>
    <!-- Menú lateral -->
    <div class="sidebar" id="sidebar">
        <img src="/Framework/public/assets/img/quacktion.jpg" alt="Quacktion" width="80">
        <a href="/Framework/public/main.php" class="btn btn-light my-2 rounded-5 border-dark">Inicio</a>
        <a href="./index.php" class="btn btn-light my-2 rounded-5 border-dark">Log in</a>
    </div>

    <!-- Miniruleta arrastrable -->
    <div id="mini-ruleta-container">
        <img id="mini-ruleta-image" src="/Framework/public/assets/img/goose-head-v36-patch-streetwear-600nw-2201843891.webp" alt="Imagen de Miniruleta">
        <svg id="mini-ruleta" width="200" height="200" viewBox="-90 -90 180 180"></svg>
        <p id="nombre-mini-ruleta"></p>
    </div>

    <!-- Ruleta Principal -->
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

    <div id="resultado"></div>

    <!-- Ventana emergente para la victoria -->
    <div id="ventana-emergente" class="ventana-emergente">
        <div class="contenido-ventana">
            <!-- Imagen de la miniruleta con corona encima -->
            <div class="imagen-corona">
                <img id="imagen-corona" src="/Framework/public/assets/img/goose-head-v36-patch-streetwear-600nw-2201843891.webp" alt="Miniruleta">
                <img id="corona" src="/Framework/public/assets/img/crown.png" alt="Corona" class="corona-imagen">
            </div>

            <h2>¡Has ganado!</h2>
            <p>Felicidades, has completado el juego.</p>

            <!-- Enlaces para ir al inicio o jugar otra vez -->
            <a href="/Framework/public/main.php" class="btn btn-light rounded-5 border-dark">Ir al inicio</a>
            <a href="./tablero.php" class="btn btn-light rounded-5 border-dark">Jugar otra vez</a>
        </div>
    </div>

    <script src="./tablero.js"></script>

</body>

</html>