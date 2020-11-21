<?php
require_once 'php/consultas.php';
session_start();
$mostrarCrear = true;

if(!isset($_SESSION["user-id"])){
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MooTics - Profile</title>
	<?php include 'includes/head.php'; ?>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container pt-2">
    <div class="row">
        <?php ?>
        <div class="col-md-4">
            <div class="p-3 bg-white rounded shadow-sm border">
                <h4>Usuario</h4>
                <?php echo $_SESSION["user"] ?>
                <h4>E-Mail:</h4>
                <?php echo $_SESSION["user-mail"] ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="p-3 bg-white rounded shadow-sm border">
                <h4 class="mt-2 mb-4">Encuestas creadas</h4>

                <?php 
                $encuestas = getEncuestas($_SESSION["user-id"]);
                if(mysqli_num_rows($encuestas)>0){
                    while($encuesta = mysqli_fetch_assoc($encuestas)){?>
                        <div class="encuesta border rounded bg-secondary text-white d-flex justify-content-between mb-3">
                            <h6 class="text-white p-3"><?php echo $encuesta['descripcion'] ?></h6>
                            <div class="e-buttons d-flex">
                                <button class="btn btn-dark rounded-0"><i class="fas fa-eye text-white"></i></button>
                                <button class="btn btn-dark rounded-0 btn-pausa" target="<?php echo $encuesta["id"] ?>">
                                    <?php if($encuesta['paused']){?>
                                        
                                        <i class="fas fa-play text-white"></i>
                                    <?php }else{ ?>
                                        <?php echo encuestaPausada($encuesta['id']) ?>
                                        <i class="fas fa-pause text-white"></i>
                                    <?php } ?>
                                    </button>
                                <button class="btn btn-danger rounded-0 rounded-right" onclick="eliminarEncuesta('<?php echo $encuesta["id"] ?>')"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    <?php }
                }else{ ?>      
                    <h5>¡No has creado ninguna encuesta!</h5>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/message-box.php' ?>
<?php include 'includes/main-scripts.php'; ?>
<script src="js/scripts.js"></script>
</body>
</html>