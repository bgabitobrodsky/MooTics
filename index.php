<?php
require_once 'php/cn.php';
require_once 'php/consultas.php';
session_start();

$mostrarIngresar = true;

$bd = cn();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MooTics</title>
	<?php include 'includes/head.php'; ?>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <?php include 'includes/main-header.php'; ?>
    <div class="row">
        <?php 
            if(isset($_GET['e'])){
                $id = $_GET['e'];
                $datos = getEncuesta($id);
                if($datos){
                    $ip = getIP();
                    if(yaVoto($id,$ip)){
                        include 'includes/tabla-resultados.php';
                    }else{
                        include 'includes/tabla-votar.php';
                    }
                    
                }else{
                    include 'includes/404.php';
                }
            }else{
                include 'includes/tabla-crear.php';
            }
        ?>
    </div>
</div>

<?php include 'includes/message-box.php' ?>

    <!-- Boostrap JS -->
<?php include 'includes/main-scripts.php'; ?>
    <script src="js/scripts.js"></script>
</body>
</html>