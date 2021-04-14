<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];
    $usu_identi = $_SESSION['sess_identificacion'];
    $usu_email = $_SESSION['sess_username'];
    $usu_nombres = $_SESSION['sess_usernom'];
    $usu_apellidos = $_SESSION['sess_userapel'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="3" && $role!="1" && $role!="2"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }

    $conexion = new Database;  
    $materias = $conexion->DatosMaterias();

    $conexion = new Database;  
    $result = $conexion->ConsultarArchivos($usu_identi,$usu_email);

    $conexion = new Database;  
    $result_total = $conexion->ConsultarTodosArchivos();
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <?php 
        if($role=="1"){
            include_once('../../administrador/menu.php'); 
        }else if($role=="2"){
            include_once('../../profesores/menu.php'); 
        }else if($role=="3"){
            include_once('../../estudiantes/menu.php'); 
        }
    ?>

    <?php  if($role=="3"){ ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Cargar Ficheros <?=  $usu_nombres.' '.$usu_apellidos ?></h3>
                        </div>

                        <?php 
                            $mensajes = array(
                                0=>"No se pudo realizar la acción, comunicate con el administrador",
                                1=>"Se guardo correctamente el archivo",
                                2=>"Se elimino correctamente el archivo"
                            );

                            $mensaje_id = isset($_GET['mensaje']) ? (int)$_GET['mensaje'] : 0;
                            $mensaje='';

                            if ($mensaje_id != '') {
                                $mensaje = $mensajes[$mensaje_id];
                                $clase = 'alert-success';
                            }

                            if ($mensaje!='') echo "<div class='alert $clase' role='alert'> $mensaje </div>";
                            
                        ?> 

                        
                        <div class="card-body">
                            <form method="POST" action="cargar.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="identificacion">Identificacion</label>
                                    <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= $usu_identi ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $usu_email ?>" required>
                                </div>


                                <div class="form-group">
                                    <label for="role">Materias</label>
                                    <select class="form-control" id="materia" name="materia">
                                        <?php 
                                            $selected ='';
                                            foreach($materias as $materia) {
                                                echo "<option value='".$materia['id']."'>".$materia['nombre']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="btn btn-primary" for="my-file-selector">
                                        <input required="" type="file" name="file">
                                    </label>
                                </div>

                                <button class="btn btn-primary" type="submit">Cargar Fichero</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Descargas Disponibles</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Identificacion</th>
                                <th scope="col">Materia</th>
                                <th scope="col">Archivo</th>
                                <th scope="col">Herramientas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    if($role=="3"){ 
                                        foreach($result as $row) {
                                            echo "<tr>
                                                    <td>".$row['estudiante']."</td>
                                                    <td>".$row['materia']."</td>
                                                    <td>".$row['archivo']."</td>
                                                    <td> <a href='subidas/".$row['archivo']."' download='".$row['archivo']."'> Descargar </a></td>
                                                    <td> <a href='eliminar.php?name=".$row['archivo']."'> Eliminar </a></td>
                                                </tr>";
                                        }
                                    }else{
                                        foreach($result_total as $row_total) {
                                            echo "<tr>
                                                    <td>".$row_total['estudiante']."</td>
                                                    <td>".$row_total['materia']."</td>
                                                    <td>".$row_total['archivo']."</td>
                                                    <td> <a href='subidas/".$row_total['archivo']."' download='".$row_total['archivo']."'> Descargar </a></td>
                                                    <td> <a href='eliminar.php?name=".$row_total['archivo']."'> Eliminar </a></td>
                                                </tr>";
                                        } 
                                    }
                                    
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>

    <script src="../../js/javascript.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>