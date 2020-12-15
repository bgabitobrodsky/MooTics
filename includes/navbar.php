
<nav class="navbar navbar-expand-lg mb-4 navbar-light">
    <?php 
        if(!isset($page))
            $page = null;
    ?>
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="./">MooTics</a>
        <?php if(isset($_SESSION['user-id'])){ ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <a href="./" class="nav-link <?php if($page == 'index') echo 'active' ?>">Crear nueva</a>
                <a href="./profile.php" class="nav-link <?php if($page == 'profile') echo 'active' ?>">Administrar</a>
                <a href="php/cerrar-sesion.php" class="nav-link">Salir</a>
            </ul>
        </div>
            <?php }else if(isset($_GET['e']) or isset($mostrarCrear)){ ?>
                <a href="./" class="nav-link">Crear encuesta</a>
            <?php }else if(isset($mostrarIngresar) and $mostrarIngresar){ ?>
                <a href="login.php" class="nav-link">Ingresar</a>
            <?php } ?>
        
    </div>
</nav>