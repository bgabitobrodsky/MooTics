<?php
require_once 'php/cn.php';
require_once 'php/consultas.php';
session_start();

$bd = cn();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MooTics</title>
	<?php include 'includes/head.php'; ?>
</head>
<body>

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

<?php if(isset($_SESSION["message"])){?>
    <div class="notification-box">
        <div class="alert alert-dismissible fade show alert-<?php echo $_SESSION["message-type"];?>" role="alert">
            <?php echo $_SESSION["message"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php unset($_SESSION["message"]); } ?>

	<!-- Boostrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>