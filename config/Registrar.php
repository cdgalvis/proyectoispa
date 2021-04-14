<?php

    include_once("DBConect.php");

    if(isset($_POST['emailregis']))      $username = $_POST['emailregis']; 
	if(isset($_POST['passwregis']))   $password = md5($_POST['passwregis']);
    if(isset($_POST['nombres']))    $nombres = $_POST['nombres'];
    if(isset($_POST['apellidos']))  $apellidos = $_POST['apellidos'];
    if(isset($_POST['confirpassword'])) $confirpassword = md5($_POST['confirpassword']);
    if(isset($_POST['identificacion'])) $identificacion = $_POST['identificacion'];
    
    $conexion = new Database;  
    $result = $conexion->ValidacionCorreo($username);
    $cantidad = $result->rowCount();


    if($cantidad > 0){
		header('Location: ../index.php?mensaje=3');
	}else{
        $conexion = new Database;  
        $result = $conexion->Registrar($username,$password,$nombres,$apellidos,$identificacion);

        header('Location: ../index.php?mensaje='.$result);
    }

?>