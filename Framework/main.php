<?php
session_start();
include_once("mysql.php");
$username = "";

if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
}
// Realizamos una consulta a la base de datos
$query = "SELECT `Code`,`Name`,`Continent` FROM `country` ORDER BY Name ASC";
$listCountry = consultar($query);

?>


<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Carmen Montalvo Luque">
    <title>Tablas</title>
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Estilo para el botón en la parte superior derecha */
        .btn-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        /* Estilo para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
            /* Para dar espacio al botón */
        }

        table,
        th,
        td {
            border: 1px solid black;
            /* Bordes negros */
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        /* Fondo gris para la tabla */
        table {
            background-color: #f2f2f2;
        }

        /* Estilo de los encabezados de la tabla */
        th {
            background-color: #d9d9d9;
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
            <form action="nuevo.php">
                <button type="submit" class="btn btn-primary">Nuevo País</button>
            </form>
            <div class="bienvenida">
                <i class="bi bi-person"></i> Bienvenido <?php echo $username; ?>
            </div>
        </div>
        <main class="form-signin m-auto">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>Código</td>
                    <td>Continente</td>
                </tr>
                <?php

                // Mostramos los datos obtenidos desde la consulta

                if ($listCountry != null) {

                    foreach ($listCountry as $objCountry) {
                        echo "<tr>";
                        echo "<td>$objCountry[Name]</td>";
                        echo "<td>$objCountry[Code]</td>";
                        echo "<td>$objCountry[Continent]</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Nos hemos encontrado ningun registro para la consulta ejecutada.";
                }
                ?>
            </table>

        </main>
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>