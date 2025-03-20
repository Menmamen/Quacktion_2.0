"use strict"
const numPretuntas = 20;
const ruleta = document.getElementById('ruleta');
        const resultado = document.getElementById('resultado');

        const categorias = [
            { color: '#E57373', nombre: 'Historia', icono: '🕰️' },
            { color: '#64B5F6', nombre: 'Geografía', icono: '🌍' },
            { color: '#81C784', nombre: 'Ciencia', icono: '🔬' },
            { color: '#FFD54F', nombre: 'Entretenimiento', icono: '🎭' },
            { color: '#FF8A65', nombre: 'Conocimiento general', icono: '⚽' },
            { color: '#BA68C8', nombre: 'Arte y Literatura', icono: '📖' }
        ];

        function crearRuleta() {
            const numSegmentos = 20;
            const anguloSegmento = 360 / numSegmentos;
            const radio = 170; // Radio de la ruleta

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
                icono.setAttribute("x", (x1 + x2) / 2 * 0.6);
                icono.setAttribute("y", (y1 + y2) / 2 * 0.6);
                icono.setAttribute("text-anchor", "middle");
                icono.setAttribute("alignment-baseline", "middle");
                icono.setAttribute("font-size", "20");
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
                let categoriaSeleccionada = categorias[segmentoSeleccionado % categorias.length];
                resultado.innerText = `Categoría: ${categoriaSeleccionada.nombre}`;
                //console.log(categoriaSeleccionada.nombre);
            }, 3000);

            //Prueba
            return resultado.innerText;
        }
        function jugar(){//Lógica de juego
            let correctas = 0;
            let incorrectas = 0;
            let categoria = resultado.innerText;
            let continuar = true;

            while (continuar) {
                

            }
        }
        async function obtenerPreguntasTrivia(cantidad = 1, categoria = null, dificultad = null, tipo = null) {
            const categorias = {
                "General Knowledge": 9, "Entertainment: Books": 10, "Entertainment: Films": 11, "Entertainment: Music": 12,
                "Entertainment: Musicals & Theatres": 13, "Entertainment: Television": 14, "Entertainment: Video Games": 15,
                "Entertainment: Board Games": 16, "Science & Nature": 17, "Science: Computers": 18, "Science: Mathematics": 19,
                "Mythology": 20, "Sports": 21, "Geography": 22, "History": 23, "Politics": 24, "Art": 25, "Celebrities": 26,
                "Animals": 27, "Vehicles": 28, "Entertainment: Comics": 29, "Science: Gadgets": 30, "Entertainment: Japanese Anime & Manga": 31,
                "Entertainment: Cartoon & Animations": 32
            };
            
            const tipos = { "multiple": "multiple", "verdadero_falso": "boolean" };
            
            let url = `https://opentdb.com/api.php?amount=${cantidad}&encode=base64`;
            if (categoria && categorias[categoria]) url += `&category=${categorias[categoria]}`;
            if (dificultad && ["easy", "medium", "hard"].includes(dificultad)) url += `&difficulty=${dificultad}`;
            if (tipo && tipos[tipo]) url += `&type=${tipos[tipo]}`;
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                if (data.response_code !== 0) {
                    throw new Error("Error al obtener preguntas de la API");
                }
                
                return data.results.map(pregunta => ({
                    question: atob(pregunta.question),
                    correct_answer: atob(pregunta.correct_answer),
                    incorrect_answers: pregunta.incorrect_answers.map(atob)
                }));
            } catch (error) {
                console.error("Error en la solicitud a la API:", error);
                return null;
            }
        }
        
        // Uso de la función
        // obtenerPreguntasTrivia(2, "Science: Computers", "easy", "multiple").then(console.log);
        
        
        function renderPregunta(){//Función que renderiza la pregunta en el tablero

            
        }

        crearRuleta();
        console.log(girarRuleta());
        //console.log(obtenerPreguntasTrivia());