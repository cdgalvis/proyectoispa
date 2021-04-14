<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="2" && $role!="1"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }

    $id_estudiante = $_GET['id'];



    $conexion = new Database;  
    $estudiante = $conexion->editEstudiante($id_estudiante);

    $estud_id = $estud_identificacion = $estud_nombres = $estud_apellidos = $estud_email = $estud_telefono = "";
    foreach($estudiante->fetchAll(PDO::FETCH_OBJ) as $r){
        $estud_id = $r->id;
        $estud_identificacion = $r->identificacion;
        $estud_nombres = $r->nombres;
        $estud_apellidos = $r->apellidos;
        $estud_email  = $r->email;
        $estud_telefono = $r->telefono;
    }

    $materias = $conexion->DatosMaterias();
    $cantidad_notas = $conexion->ConsultarCantidadNotas($estud_identificacion);

    $cantidad = $cantidad_notas->rowCount();
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
        }
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong> <?= 'Notas '.$estud_nombres.' '.$estud_apellidos; ?> </strong>

                        <a href="<?= ROOT ?>modulos/estudiantes/estudiantes.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">

                    <form action='add.php' method='POST'>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Estudiante</th>
                                    <th scope='col'>Materia</th>
                                    <th scope='col'>Nota 1</th>
                                    <th scope='col'>Nota 2</th>
                                    <th scope='col'>Nota 3</th>
                                    <th scope='col'>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    if($cantidad == 0){

                                        $ident = 0;
                                        foreach($materias as $materia) {
                                            echo " <tr>
                                                        <td>
                                                            <input type='text' class='form-control' id='identificacion' name='identificacion' size='40' value='".$estud_identificacion."'>
                                                            <input type='hidden' class='form-control' id='idestudiante' name='idestudiante'value='".$estud_id."'>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' id='materia$ident' name='materia$ident' size='40' value='".$materia['nombre']."'>
                                                            <input type='hidden' class='form-control' id='idmateria$ident' name='idmateria$ident' size='40' value='".$materia['id']."'>
                                                        </td>
                                                        <td><input type='text' class='form-control' id='nota1$ident' name='nota1$ident' value=''></td>
                                                        <td><input type='text' class='form-control' id='nota2$ident' name='nota2$ident' value=''></td>
                                                        <td><input type='text' class='form-control' id='nota3$ident' name='nota3$ident' value=''></td>
                                                        <td><textarea class='form-control' id='observacion$ident' name='observacion$ident'></textarea></td>
                                                    </tr>
                                                    ";

                                            $ident++;
                                        }

                                    }else{

                                        $ident = 0;
                                        $materiageneral = '';
                                        foreach($materias as $materia) {
                                            echo "  <tr>
                                                        <td>
                                                            <input type='text' class='form-control' id='identificacion' name='identificacion' size='40' value='".$estud_identificacion."'>
                                                            <input type='hidden' class='form-control' id='idestudiante' name='idestudiante'value='".$estud_id."'>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' id='materia$ident' name='materia$ident' size='40' value='".$materia['nombre']."'>
                                                            <input type='hidden' class='form-control' id='idmateria$ident' name='idmateria$ident' size='40' value='".$materia['id']."'>
                                                        </td>";

                                            $notas = $conexion->ConsultarNotas($estud_identificacion,$materia['id']);
                                            $cantidadnotas = $notas->rowCount();

                                            if($cantidadnotas==0){
                                                echo "  <td><input type='text' class='form-control' id='nota1$ident' name='nota1$ident' value=''></td>
                                                        <td><input type='text' class='form-control' id='nota2$ident' name='nota2$ident' value=''></td>
                                                        <td><input type='text' class='form-control' id='nota3$ident' name='nota3$ident' value=''></td>
                                                        <td><textarea class='form-control' id='observacion$ident' name='observacion$ident'></textarea></td> 
                                                    </tr> ";
                                            }else{
                                                foreach($notas as $nota) {
                                                    echo "  <td><input type='text' class='form-control' id='nota1$ident' name='nota1$ident' value='".$nota['nota1']."'></td>
                                                            <td><input type='text' class='form-control' id='nota2$ident' name='nota2$ident' value='".$nota['nota2']."'></td>
                                                            <td><input type='text' class='form-control' id='nota3$ident' name='nota3$ident' value='".$nota['nota3']."'></td>
                                                            <td><textarea class='form-control' id='observacion$ident' name='observacion$ident'>".$nota['observacion']."</textarea></td>
                                                        </tr>";
                                                }
                                            }
                                            
                                            $ident++;
                                        }
                                    }    


                                    
                                ?>

                                <input type='hidden' class='form-control' id='identificador' name='identificador' value='<?= $ident ?>'>
                            </tbody>
                        </table> 

                        <button type="submit" class="btn btn-primary">Guardar Notas</button>
                    </form> 


                    </div>
                </div>
            </div>
        </div>
    <div>

    <script src="../../js/javascript.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>