"use strict";

window.onload = function () {
    const iconUser = document.getElementById("icon-user");
    const btnChangeIcon = document.getElementById("btn-change-icon");
    const iconModal = document.getElementById("icon-modal");
    const btnCloseModal = document.getElementById("btn-close-modal");
    const previewContainer = document.getElementById("icon-preview-container");

    let iconosDisponibles = [
        "https://pbs.twimg.com/media/EN9pNO_XUAEoJsA.jpg:large",
        "https://us-tuna-sounds-images.voicemod.net/d56176c8-243b-4216-bdce-d9819a8f32bb-1692903460443.jpg",
        "https://ih1.redbubble.net/image.3227519140.1976/flat,750x,075,f-pad,750x1000,f8f8f8.jpg",
        "https://i.pinimg.com/736x/55/b3/eb/55b3eb089c18b503b23f26ef9ebf48d6.jpg",
        "https://static.vecteezy.com/system/resources/previews/045/938/807/non_2x/a-swimming-circle-in-the-form-of-a-yellow-duck-with-big-round-eyes-a-bright-orange-beak-and-a-cute-tail-this-float-duck-is-perfect-for-a-summer-themed-pool-party-isolated-illustration-vector.jpg",
        "/Framework/public/assets/img/goose-head-v36-patch-streetwear-600nw-2201843891.webp",
        "/Framework/public/assets/img/anonimo.webp"
    ];

    // Llenar la ventana modal con imágenes
    iconosDisponibles.forEach(icono => {
        let img = document.createElement("img");
        img.src = icono;
        img.className = "icon-preview";
        img.dataset.value = icono;

        // Al hacer clic en un icono, cambiarlo y cerrar la ventana
        img.addEventListener("click", function () {
            iconUser.src = icono;
            localStorage.setItem("userIcon", icono);
            iconModal.style.display = "none";
        });

        previewContainer.appendChild(img);
    });

    // Cargar icono guardado en localStorage
    const savedIcon = localStorage.getItem("userIcon");
    if (savedIcon && iconosDisponibles.includes(savedIcon)) {
        iconUser.src = savedIcon;
    }

    // Mostrar la ventana modal al hacer clic en "Cambiar Icono"
    btnChangeIcon.addEventListener("click", function () {
        iconModal.style.display = "flex";
    });

    // Cerrar la ventana modal
    btnCloseModal.addEventListener("click", function () {
        iconModal.style.display = "none";
    });

    // Cerrar la ventana modal al hacer clic fuera de ella
    window.addEventListener("click", function (event) {
        if (event.target === iconModal) {
            iconModal.style.display = "none";
        }
    });

    

};