
<nav class="navbar navbar-expand-lg mb-4 navbar-light">
    <?php 
        if(!isset($page))
            $page = null;
    ?>
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="./">MooTics</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <hr>
            <form class="input-group col-lg-6 ml-auto search-container" action="search.php" method="GET">
                <input type="text" class="form-control" name="q" id="search-input" placeholder="Buscar encuestas públicas" required>
                <input type="hidden" name="page" value="1">
                <button class="btn btn-primary btn-sm" id="btn-search"><i class="fas fa-search text-white"></i></button>
            </form>
            <hr>
            
            <ul class="navbar-nav ml-auto">
            
                <a href="./" class="nav-link <?php if($page == 'index') echo 'active' ?>">Crear encuesta</a>
                <?php if(isset($_SESSION['user-id'])){ ?>
                <a href="./profile.php" class="nav-link <?php if($page == 'profile') echo 'active' ?>">Administrar</a>
                <a href="php/cerrar-sesion.php" class="nav-link">Salir</a>
                <?php }else{ ?>
                    <a href="login.php" class="nav-link <?php if($page == 'login') echo 'active' ?>">Acceder</a>
                <?php } ?>
            </ul>
            
        </div>
            
        
    </div>
</nav>