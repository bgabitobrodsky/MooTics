
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="./">MooTics</a>
        

        <?php if(isset($_SESSION['user-id'])){ ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <a href="./" class="nav-link btn btn-dark mx-1 <?php if(getPage() == '/encuestas/' || getPage() == '/encuestas/.index.php') echo 'active' ?>">Crear nueva</a>
                <a href="./profile.php" class="nav-link btn btn-dark mx-1 <?php if(getPage() == '/encuestas/profile.php') echo 'active' ?>">Administrar</a>
                <a href="php/cerrar-sesion.php" class="nav-link btn btn-dark ml-1">Salir</a>
            </ul>

            <?php }else if(isset($_GET['e']) or isset($mostrarCrear)){ ?>
                <a href="./" class="btn btn-dark">Crear encuesta</a>
            <?php }else if(isset($mostrarIngresar) and $mostrarIngresar){ ?>
                <a href="login.php" class="btn btn-dark">Ingresar</a>
            <?php } ?>
        </div>
    </div>
</nav>