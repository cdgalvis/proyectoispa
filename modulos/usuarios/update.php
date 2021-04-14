<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    if(isset($_POST['nombres']))        $nombres = $_POST['nombres']; 
    if(isset($_POST['id']))             $id = $_POST['id']; 
    if(isset($_POST['apellidos']))      $apellidos = $_POST['apellidos']; 
    if(isset($_POST['username']))       $username = $_POST['username']; 
    if(isset($_POST['role']))           $role = $_POST['role']; 
    if(isset($_POST['password']))       $password = $_POST['password']; 
    if(isset($_POST['identificacion'])) $identificacion = $_POST['identificacion']; 
    
    $conexion = new Database;  
    $result = $conexion->updateUsuario($id,$nombres,$apellidos,$username,$role,$password,$identificacion);

    header("Location: ".ROOT."modulos/usuarios/usuarios.php?mensaje=".$result);

?>