<!-- Pantalla principal del juego -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quacktion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #102F31;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
/*             background-image: url("../../fondo.png");
            background-repeat: repeat;
            background-size: 100px; */
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
            display: grid;
            grid-template-columns: minmax(100px, 40%) minmax(100px, 20%) minmax(100px, 40%);
            gap: 25px;
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            justify-content: center;
            min-height: 200px;
        }

        #ranking,
        #botones,
        #tutorial {
            background-color: rgba(255, 255, 255, 0.1); 
            padding: 20px;
            border-radius: 10px;
            justify-content: center;
            align-items: center;
        }

        #botones {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            min-width: 100px;
        }

        #botones button {
            background-color: #1E6063;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 80%;
            min-width: 80px;
            max-width: 300px;
            font-size: clamp(14px, 2vw, 18px);
            opacity: 1;
            z-index: 1;
        }

        #botones button:hover {
            background-color: #258084;
        }

        footer {
            position: fixed;
            bottom: 0;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2); 
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        footer div {
            color: white;
            font-size: 15px;
            opacity: 1;
        }

        @media screen and (max-width: 768px) {
            #cuerpo {
                grid-template-columns: 1fr;
                width: 100%;
                margin: 20px 10px;
            }

            #ranking,
            #botones,
            #tutorial {
                min-height: 80px;
                padding: 15px;
                /* Ajustar el padding para pantallas pequeñas */
            }

            #botones button {
                width: 90%;
                /* Asegurar que los botones ocupen el 90% */
                min-width: 180px;
                /* Ajustar el ancho mínimo de los botones en pantallas pequeñas */
            }
        }
    </style>
</head>

<body>
    <div id="logo">
        <img src="./img/quacktion.jpg" alt="logo">
    </div>
    <div id=cuerpo>
        <div id="ranking"></div>
        <div id="botones">
            <button id="invitados">Jugar como invitado</button>
            <button id="salir">Iniciar sesión</button>
        </div>
        <div id="tutorial"></div>
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
</body>

</html>