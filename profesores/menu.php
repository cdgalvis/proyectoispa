<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="<?= ROOT ?>img/logo.jpg" width="50px" height="50px" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- Modulo Docente -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Estudiantes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/estudiantes/estudiantes.php">Ver Estudiantes</a>
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/materias/materias.php">Materias</a>
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/archivos/archivos.php">Archivos</a>
                </div>
            </li>
        </ul>
        <!-- Modulo Administrador -->
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['sess_usernom'].' '.$_SESSION['sess_userapel'];?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= ROOT ?>config/logout.php">Cerrar sesión</a>
                </div>
            </li>
        </ul>
        
    </div>
</nav>