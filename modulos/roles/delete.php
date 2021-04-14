<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->EliminarRol($id);

    header("Location: ".ROOT."modulos/roles/roles.php?mensaje=".$result);

?>