<?php
$domain = "localhost";
$usuario = "root";
$pword = "";
$database = "Quacktion";
$port = 3306;

function consultar($consulta)
{
    global $domain, $usuario, $pword, $database, $port;
    $resultado = null;
    $con = mysqli_connect($domain, $usuario, $pword, $database, $port);
    if (!$con) {
        die("Error en la conexión: " . mysqli_connect_error());
    } else {
        $resultado = mysqli_query($con, $consulta);
        mysqli_close($con);
    }

    return $resultado;
}

function insertar($insercion){
    global $domain, $usuario, $pword, $database, $port;
    $con = mysqli_connect($domain, $usuario, $pword, $database, $port);
    if (!$con) {
        die("Error en la conexión: " . mysqli_connect_error());
        return false;
    } else {
        if (mysqli_query($con, $insercion)) {
            mysqli_close($con);
            return true;
        } else {
            mysqli_close($con);
            return false;
        }
    }
}
?>