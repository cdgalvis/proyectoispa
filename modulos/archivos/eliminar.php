<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $archivo = $_GET['name'];
    $ruta_archivo = 'subidas/'.$_GET['name'];
    $usu_identi = $_SESSION['sess_identificacion'];
    $usu_email = $_SESSION['sess_username'];

    unlink($ruta_archivo);

    $conexion = new Database;  
    $result = $conexion->EliminarArchivos($archivo,$usu_identi,$usu_email);

    header("Location: ".ROOT."modulos/archivos/archivos.php?mensaje=".$result);

?>