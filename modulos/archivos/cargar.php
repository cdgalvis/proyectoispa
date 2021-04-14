<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");
    // Cómo subir el archivo
    $fichero = $_FILES["file"];

    if(isset($_POST['username']))       $username = $_POST['username']; 
    if(isset($_POST['materia']))        $materia = $_POST['materia']; 
    if(isset($_POST['identificacion'])) $identificacion = $_POST['identificacion']; 

    $nombre_archivo = $identificacion.'_'.$fichero["name"];

    $conexion = new Database;  
    $result = $conexion->CrearArchivos($username,$materia,$identificacion,$nombre_archivo);

    // Cargando el fichero en la carpeta "subidas"
    move_uploaded_file($fichero["tmp_name"], "subidas/".$nombre_archivo);

    // Redirigiendo hacia atrás
    header("Location: ".ROOT."modulos/archivos/archivos.php?mensaje=".$result);
?>