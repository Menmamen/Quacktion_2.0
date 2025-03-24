<?php
// <<<<<<< HEAD
header('Content-Type: application/json'); // Asegura que se devuelve JSON
echo json_encode(["pregunta" => "¿Cuál es la capital de Francia?"]); // Prueba con esto
// function obtenerPreguntasTrivia($cantidad = 10, $categoria = null, $dificultad = null, $tipo = null) {
// =======

function obtenerPreguntasTrivia($cantidad = 1, $categoria = null, $dificultad = null, $tipo = null) {
// >>>>>>> cbe4457be4395ea2c4f392bf5d50195817bcd04a
    // Mapeo de categorías en → ID de OpenTDB
    $categorias = [
        "General Knowledge" => 9, "Entertainment: Books" => 10, "Entertainment: Films" => 11, "Entertainment: Music" => 12, "Entertainment: Musicals & Theatres" => 13,
        "Entertainment: Television" => 14, "Entertainment: Video Games" => 15, "Entertainment: Board Games" => 16, "Science & Nature" => 17,
        "Science: Computers" => 18, "Science: Mathematics" => 19, "Mythology" => 20, "Sports" => 21,
        "Geography" => 22, "History" => 23, "Politics" => 24, "Art" => 25, "Celebrities" => 26,
        "Animals" => 27, "Vehicles" => 28, "Entertainment: Comics" => 29, "Science: Gadgets" => 30, 
        "Entertainment: Japanese Anime & Manga" => 31, "Entertainment: Cartoon & Animations" => 32
    ];

    // Mapeo de tipos de preguntas
    $tipos = ["multiple" => "multiple", "verdadero_falso" => "boolean"];

    // Validaciones y valores por defecto
    $cantidad = is_numeric($cantidad) && $cantidad > 0 ? intval($cantidad) : 10;
    $categoria = $categorias[strtolower($categoria)] ?? null; // Convierte la categoría a ID
    $dificultad = in_array($dificultad, ["easy", "medium", "hard"]) ? $dificultad : null;
    $tipo = $tipos[strtolower($tipo)] ?? null; // Convierte el tipo a formato API

    // Construcción de la URL con los parámetros
    $url = "https://opentdb.com/api.php?amount=$cantidad&encode=base64";
    if ($categoria) $url .= "&category=$categoria";
    if ($dificultad) $url .= "&difficulty=$dificultad";
    if ($tipo) $url .= "&type=$tipo";

    // Obtener datos de la API
    $json = @file_get_contents($url);
    if (!$json) {
        return ["error" => "No se pudo conectar con la API de OpenTDB."];
    }

    $data = json_decode($json, true);
    
    if (!isset($data["response_code"])) {
        return ["error" => "Respuesta inválida de la API."];
    }

    // Control de errores según el código de respuesta
    switch ($data["response_code"]) {
        case 0: break; // Todo correcto
        case 1: return ["error" => "No hay suficientes preguntas para los parámetros seleccionados."];
        case 2: return ["error" => "Parámetro inválido en la solicitud."];
        case 3: return ["error" => "Token no válido o caducado."];
        case 4: return ["error" => "Demasiadas solicitudes. Intenta más tarde."];
        default: return ["error" => "Error desconocido al obtener preguntas."];
    }

    // Decodificar las preguntas y respuestas desde Base64
    foreach ($data["results"] as &$pregunta) {
        $pregunta["question"] = base64_decode($pregunta["question"]);
        $pregunta["correct_answer"] = base64_decode($pregunta["correct_answer"]);
        foreach ($pregunta["incorrect_answers"] as &$respuesta) {
            $respuesta = base64_decode($respuesta);
        }
    }

    return $data["results"];
}

//Ejemplo:
// $preguntas = obtenerPreguntasTrivia(20, "", "", "");

// if (isset($preguntas["error"])) {
//     echo "<p>Error: " . $preguntas["error"] . "</p>";
// } else {
//     echo "<pre>";
//     print_r($preguntas);
//     echo "</pre>";
// }

// ?>
