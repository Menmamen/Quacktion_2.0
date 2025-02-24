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
    // Consultar la base de datos
    $con = mysqli_connect($domain, $usuario, $pword, $database, $port);
    if (!$con) {
        die("Error en la conexión: " . mysqli_connect_error());
    } else {
        //echo "Conexion correcta<br><br>";
        // Realizamos una consulta a la base de datos
        $resultado = mysqli_query($con, $consulta);
        mysqli_close($con);
    }

    return $resultado;
}

function insertar($insercion){
    global $domain, $usuario, $password, $database, $port;
    $con = mysqli_connect($domain, $usuario, $password, $database, $port);
    if (!$con) {
        die("Error en la conexión: " . mysqli_connect_error());
        return false;
    } else {
        //echo "Conexion correcta<br><br>";
        // Realizamos una inserción a la base de datos
        mysqli_query($con, $insercion);
        mysqli_close($con);
        return true;
    }
}
?>