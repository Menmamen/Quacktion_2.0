"use strict"

const numPretuntas = 20;
const ruleta = document.getElementById('ruleta');
const miniRuleta = document.getElementById('mini-ruleta');
const resultado = document.getElementById('resultado');

let puntuacion = {
    "Historia": false,
    "Geografía": false,
    "Ciencia": false,
    "Entretenimiento": false,
    "Conocimiento general": false,
    "Arte y Literatura": false
};

const categorias = [
    { color: '#E57373', nombre: 'Historia', icono: '🕰️' },
    { color: '#64B5F6', nombre: 'Geografía', icono: '🌍' },
    { color: '#81C784', nombre: 'Ciencia', icono: '🔬' },
    { color: '#FFD54F', nombre: 'Entretenimiento', icono: '🎭' },
    { color: '#FF8A65', nombre: 'Conocimiento general', icono: '🧠' },
    { color: '#BA68C8', nombre: 'Arte y Literatura', icono: '📖' }
];

function crearRuleta() {
    const numSegmentos = 20;
    const anguloSegmento = 360 / numSegmentos;
    const radio = 255; // Radio de la ruleta

    for (let i = 0; i < numSegmentos; i++) {
        const categoria = categorias[i % categorias.length];
        const anguloInicio = i * anguloSegmento;
        const anguloFin = (i + 1) * anguloSegmento;

        const x1 = Math.cos((anguloInicio - 90) * Math.PI / 180) * radio;
        const y1 = Math.sin((anguloInicio - 90) * Math.PI / 180) * radio;
        const x2 = Math.cos((anguloFin - 90) * Math.PI / 180) * radio;
        const y2 = Math.sin((anguloFin - 90) * Math.PI / 180) * radio;

        const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
        path.setAttribute("d", `M 0 0 L ${x1} ${y1} A ${radio} ${radio} 0 0 1 ${x2} ${y2} Z`);
        path.setAttribute("fill", categoria.color);
        path.setAttribute("stroke", "white");
        path.setAttribute("stroke-width", "2");
        ruleta.appendChild(path);

        // Agregar icono
        const icono = document.createElementNS("http://www.w3.org/2000/svg", "text");
        icono.setAttribute("x", (x1 + x2) / 2 * 0.8);  // Más cerca del borde (antes 0.6)
        icono.setAttribute("y", (y1 + y2) / 2 * 0.8);  // Más cerca del borde (antes 0.6)
        icono.setAttribute("text-anchor", "middle");
        icono.setAttribute("alignment-baseline", "middle");
        icono.setAttribute("font-size", "28");  // Iconos más grandes (antes 20)
        icono.setAttribute("fill", "white");
        icono.textContent = categoria.icono;
        ruleta.appendChild(icono);
    }
}

let anguloActual = 0;

function girarRuleta() {
    const giros = Math.floor(Math.random() * 3) + 3;
    const anguloGiro = Math.floor(Math.random() * 360);
    anguloActual += giros * 360 + anguloGiro;
    ruleta.style.transform = `rotate(${anguloActual}deg)`;

    setTimeout(() => {
        const anguloFinal = anguloActual % 360;
        const segmentoSeleccionado = Math.floor(((360 - anguloFinal) % 360) / (360 / 20));
        const categoriaSeleccionada = categorias[segmentoSeleccionado % 6];

        console.log("Ángulo final:", anguloFinal);
        console.log("Segmento seleccionado:", segmentoSeleccionado);
        console.log("Categoría seleccionada:", categoriaSeleccionada);

        resultado.innerText = `Categoría: ${categoriaSeleccionada.nombre}`;

        let categoriaID = asignarCategoria(categoriaSeleccionada.nombre);
        console.log("ID de categoría asignado:", categoriaID);

        obtenerPreguntasTrivia(1, categoriaID)
            .then(preguntas => {
                if (preguntas && preguntas.length > 0) {
                    setTimeout(() => {
                        renderPregunta(preguntas[0]);
                    }, 500);
                } else {
                    console.error("No se obtuvieron preguntas.");
                }
            })
            .catch(error => console.error("Error obteniendo preguntas:", error));
    }, 3000);
}


function jugar() { // Lógica de juego
    let correctas = 0;
    let incorrectas = 0;
    let categoria = resultado.innerText;
    let continuar = true;

    while (continuar) {

    }
}

async function obtenerPreguntasTrivia(cantidad = 1, categoriaID = null, dificultad = null, tipo = "multiple") {
    const tipos = { "multiple": "multiple", "verdadero_falso": "boolean" };

    let url = `https://opentdb.com/api.php?amount=${cantidad}&encode=base64`;
    if (categoriaID) url += `&category=${categoriaID}`;
    if (dificultad && ["easy", "medium", "hard"].includes(dificultad)) url += `&difficulty=${dificultad}`;
    if (tipo && tipos[tipo]) url += `&type=${tipos[tipo]}`;

    console.log("URL de la API:", url); // Agregado para depuración

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.response_code !== 0) {
            throw new Error("Error al obtener preguntas de la API");
        }

        return data.results.map(pregunta => ({
            question: atob(pregunta.question),
            correct_answer: atob(pregunta.correct_answer),
            incorrect_answers: pregunta.incorrect_answers.map(atob),
            type: atob(pregunta.type)
        }));
    } catch (error) {
        console.error("Error en la solicitud a la API:", error);
        return null;
    }
}

// Uso de la función
// obtenerPreguntasTrivia(2, "Science: Computers", "easy", "multiple").then(console.log);

function renderPregunta(preguntaData) {
    const preguntaContainer = document.getElementById('pregunta-container');
    const preguntaTexto = document.getElementById('pregunta-texto');
    const opcionesDiv = document.getElementById('opciones');
    const botonRuleta = document.getElementById("boton-girar");
    const flecha = document.getElementById("flecha");

    // *LIMPIAR CONTENIDO ANTES DE AGREGAR LA NUEVA PREGUNTA*
    preguntaTexto.innerText = "";
    opcionesDiv.innerHTML = "";

    // Asegurar que la ruleta desaparece y la pregunta se muestra
    ruleta.style.opacity = "0";
    botonRuleta.style.opacity = "0";
    flecha.style.opacity = "0";

    setTimeout(() => {
        ruleta.style.display = 'none';
        botonRuleta.style.display = 'none';
        flecha.style.display = 'none';
        preguntaContainer.style.display = 'block';
        preguntaContainer.style.opacity = "1";

        // *Mostrar la pregunta*
        preguntaTexto.innerText = preguntaData.question;

        // *Crear botones para las respuestas*
        const respuestas = [preguntaData.correct_answer, ...preguntaData.incorrect_answers];
        respuestas.sort(() => Math.random() - 0.5); // Mezclar opciones

        respuestas.forEach(respuesta => {
            const boton = document.createElement("button");
            boton.innerText = respuesta;
            boton.className = "btn btn-primary text-dark m-2"; // Texto negro

            // Asignar un atributo de control al botón correcto
            if (respuesta === preguntaData.correct_answer) {
                boton.dataset.correct = "true";
            }

            // Se pasa el botón clicado (this) para evaluar sin recorrer todas las opciones
            boton.onclick = function () {
                responderPregunta(this, respuesta, preguntaData.correct_answer);
            };
            opcionesDiv.appendChild(boton);
        });
    }, 500);
    console.log(puntuacion);

}

function comprobarGanar(puntuacion) {
    let respuesta = false;
    array.forEach(puntuacion => {

    });
}


function responderPregunta(botonClicado, respuestaUsuario, respuestaCorrecta) {
    const preguntaContainer = document.getElementById('pregunta-container');
    const ruleta = document.getElementById('ruleta');
    const botonRuleta = document.getElementById("boton-girar");
    const flecha = document.getElementById("flecha");

    // 🟢 **Obtener la categoría actual del resultado mostrado en pantalla**
    let categoriaActual = resultado.innerText.replace("Categoría: ", "").trim();

    // Desactivar el botón clicado
    botonClicado.disabled = true;

    if (respuestaUsuario === respuestaCorrecta) {
        botonClicado.classList.remove("btn-primary", "text-dark");
        botonClicado.classList.add("btn-success", "text-white"); // ✅ Respuesta correcta en verde
        // Actualizar la puntuación solo si la categoría aún no estaba ganada
        puntuacion[categoriaActual] = true;
        crearMiniRuleta();
        console.log(`✅ ¡Categoría conseguida!: ${categoriaActual}`, puntuacion);
    } else {
        // Si la respuesta es incorrecta, marcar el botón pulsado en rojo
        botonClicado.classList.remove("btn-primary", "text-dark");
        botonClicado.classList.add("btn-danger", "text-white"); // ❌ Respuesta incorrecta en rojo

        // Marcar el botón correcto (sin recorrer todos los botones, se utiliza un selector directo)
        const botonCorrecto = document.querySelector("#opciones button[data-correct='true']");
        if (botonCorrecto) {
            botonCorrecto.classList.remove("btn-primary", "text-dark");
            botonCorrecto.classList.add("btn-success", "text-white");
        }
    }

    // **Esperar 2 segundos antes de continuar**
    setTimeout(() => {
        preguntaContainer.style.opacity = "0";

        setTimeout(() => {
            preguntaContainer.style.display = 'none';
            ruleta.style.display = 'block';
            botonRuleta.style.display = 'block';
            flecha.style.display = 'block';

            setTimeout(() => {
                ruleta.style.opacity = "1";
                botonRuleta.style.opacity = "1";
                flecha.style.opacity = "1";

                // 🏆 **Comprobar si ha ganado el juego**
                if (Object.values(puntuacion).every(val => val)) {
                    setTimeout(() => {
                        const ventanaEmergente = document.getElementById('ventana-emergente');
                        ventanaEmergente.style.display = 'block';
                    }, 500);
                }

            }, 50);

        }, 500);

    }, 2000);
    console.log("Respuesta del usuario:", puntuacion);
}


crearRuleta();


function asignarCategoria(nombreCategoria) {
    let categoriaID;

    switch (nombreCategoria) {
        case "Historia":
            categoriaID = [23, 24][Math.floor(Math.random() * 2)];
            break;
        case "Geografía":
            categoriaID = 22;
            break;
        case "Ciencia":
            categoriaID = [17, 27, 28, 30][Math.floor(Math.random() * 4)];
            break;
        case "Entretenimiento":
            categoriaID = [11, 13, 14, 15, 16, 26, 29, 31, 32][Math.floor(Math.random() * 9)];
            break;
        case "Conocimiento general":
            categoriaID = 9;
            break;
        case "Arte y Literatura":
            categoriaID = [10, 12, 25][Math.floor(Math.random() * 3)];
            break;
        default:
            categoriaID = 9; // Valor por defecto
    }

    return categoriaID;
}

function crearMiniRuleta() {
    const numSegmentos = 6;
    const anguloSegmento = 360 / numSegmentos;
    const radio = 60; // Tamaño de la miniruleta
    const miniRuleta = document.getElementById('mini-ruleta'); // Asegúrate de tener el contenedor SVG

    // Asegurarse de limpiar la ruleta antes de añadir los nuevos segmentos
    miniRuleta.innerHTML = '';

    for (let i = 0; i < numSegmentos; i++) {
        const categoria = categorias[i]; // Usar las categorías del array 'categorias'
        const anguloInicio = i * anguloSegmento;
        const anguloFin = (i + 1) * anguloSegmento;

        const x1 = Math.cos((anguloInicio - 90) * Math.PI / 180) * radio;
        const y1 = Math.sin((anguloInicio - 90) * Math.PI / 180) * radio;
        const x2 = Math.cos((anguloFin - 90) * Math.PI / 180) * radio;
        const y2 = Math.sin((anguloFin - 90) * Math.PI / 180) * radio;

        const path = document.createElementNS("http://www.w3.org/2000/svg", "path");

        // Si la categoría ha sido acertada, se le asigna el color de 'categorias', sino se deja sin color
        const color = puntuacion[categoria.nombre] ? categoria.color : "#E0E0E0"; // Gris para los que no están acertados
        path.setAttribute("d", `M 0 0 L ${x1} ${y1} A ${radio} ${radio} 0 0 1 ${x2} ${y2} Z`);
        path.setAttribute("fill", color);
        path.setAttribute("stroke", "white");
        path.setAttribute("stroke-width", "2");

        miniRuleta.appendChild(path);
    }
}


crearMiniRuleta();

// **Toggler Sidebar**
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('hidden');
}

// Funcionalidad para arrastrar la miniruleta
const miniRuletaContainer = document.getElementById('mini-ruleta-container');

let isDragging = false;
let offsetX, offsetY;

miniRuletaContainer.addEventListener('mousedown', (event) => {
    isDragging = true;
    offsetX = event.clientX - miniRuletaContainer.getBoundingClientRect().left;
    offsetY = event.clientY - miniRuletaContainer.getBoundingClientRect().top;
    miniRuletaContainer.style.cursor = 'grabbing'; // Cambiar el cursor cuando está arrastrando
});

document.addEventListener('mousemove', (event) => {
    if (isDragging) {
        const left = event.clientX - offsetX;
        const top = event.clientY - offsetY;
        miniRuletaContainer.style.left = `${left}px`;
        miniRuletaContainer.style.top = `${top}px`;
    }
});

document.addEventListener('mouseup', () => {
    isDragging = false;
    miniRuletaContainer.style.cursor = 'move'; // Volver a cambiar el cursor a 'move'
});