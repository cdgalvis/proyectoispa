<?php 
    session_start();
    $role = $_SESSION['sess_userrole'];

    include_once("../config/DBConect.php");
    include_once("../config/Config.php");
 
    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="3" && $role!="1"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <?php include_once('menu.php'); ?>

    <script src="../js/javascript.js" ></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>