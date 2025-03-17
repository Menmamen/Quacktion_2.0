"use strict"

const ruleta = document.getElementById('ruleta');
        const resultado = document.getElementById('resultado');

        const categorias = [
            { color: '#E57373', nombre: 'Historia', icono: '🕰️' },
            { color: '#64B5F6', nombre: 'Geografía', icono: '🌍' },
            { color: '#81C784', nombre: 'Ciencia', icono: '🔬' },
            { color: '#FFD54F', nombre: 'Entretenimiento', icono: '🎭' },
            { color: '#FF8A65', nombre: 'Deportes', icono: '⚽' },
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
                const categoriaSeleccionada = categorias[segmentoSeleccionado % categorias.length];
                resultado.innerText = `Categoría: ${categoriaSeleccionada.nombre}`;
            }, 3000);
        }

        crearRuleta();