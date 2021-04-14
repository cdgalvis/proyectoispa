<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="./css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-login-list" data-toggle="list" href="#list-login" role="tab" aria-controls="login">Login</a>
                            <a class="list-group-item list-group-item-action" id="list-register-list" data-toggle="list" href="#list-register" role="tab" aria-controls="register">Register</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-login" role="tabpanel" aria-labelledby="list-login-list">
                                <form action="config/Authenticate.php" method="POST">

                                <?php 
                                    $mensajes = array(
                                        0=>"No se pudo realizar la acción, comunicate con el administrador",
                                        1=>"Nombre de usuario o contraseña no válidos, Inténtelo de nuevo",
                                        2=>"Por favor, inicie sesión para acceder a esta área",
                                        3=>"No se puede registrar debido a que ya existe una cuenta con el mismo correo electronico",
                                        4=>"No tienes acceso a esta area, Inicia sesion nuevamente",
                                        5=>"Se registro correctamente"
                                    );

                                    $mensaje_id = isset($_GET['mensaje']) ? (int)$_GET['mensaje'] : 0;
                                    $mensaje='';

                                    if($mensaje_id=='5'){
                                        $clase = 'alert-success';
                                    }else{
                                        $clase = 'alert-danger';
                                    }

                                    if ($mensaje_id != '') {
                                        $mensaje = $mensajes[$mensaje_id];
                                    }

                                    if ($mensaje!='') echo "<div class='alert $clase' role='alert'> $mensaje </div>";
                                    
                                ?>  
                                
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                                        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </form>     
                            </div>
                            <div class="tab-pane fade" id="list-register" role="tabpanel" aria-labelledby="list-register-list">
                                <form action="config/Registrar.php" method="POST" name="forregistro">

                                    <div id='mensaje'> </div>
                                    
                                    <div class="form-group">
                                        <label for="identificacion">Identificacion</label>
                                        <input type="text" class="form-control" id="identificacion" name="identificacion">
                                    </div>

                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                    </div>

                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" class="form-control" id="emailregis" name="emailregis" aria-describedby="emailHelp">
                                        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="passw">Contraseña</label>
                                        <input type="password" class="form-control" id="passwregis" name="passwregis">
                                    </div>

                                    <div class="form-group">
                                        <label for="confirpassword">Confirmar Contraseña</label>
                                        <input type="password" class="form-control" id="confirpassword" name="confirpassword">
                                    </div>
                                    
                                    <input type="button" class="btn btn-primary" onclick="ValidarRegistro()" value='Registrar'>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>

    <script src="./js/javascript.js" ></script>
    <script src="./js/validaciones.js" ></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js" ></script>

</body>
</html>