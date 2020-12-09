<?php
require_once 'php/cn.php';
require_once 'php/consultas.php';
require_once 'php/Encuesta.php';
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
    <?php if(!isset($_GET['e'])) include 'includes/main-header.php'; ?>
    <div class="row">
        <?php 
            if(isset($_GET['e'])){
                $id = $_GET['e'];
                $encuesta = new Encuesta($id);
                if($encuesta->datos){
                    $ip = getIP();
                    if(yaVoto($id,$ip) or $encuesta->pausada()){
                        $encuesta->tabla_resultados();
                    }else{
                        $encuesta->tabla_votar();
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