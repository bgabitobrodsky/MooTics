<?php
require_once 'php/consultas.php';
require_once 'php/Encuesta.php';
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
<div class="container">
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
                <h3>Encuestas creadas</h3>
                <hr>
                <div id="encuestas-container">
                
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-encuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ver-pregunta"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-0" id="ver-opciones-container">
			
			
            </div>
            <div class="alert alert-info m-0">
				<div class="link-box">
					<a id='link' href="index.php?e=">
						
					</a>
					<button class="btn btn-sm btn-primary btn-copy-link" data-toggle="tooltip" title="Copiar"><i class="far fa-clipboard text-white"></i></button>
				</div>
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="notification-box" id="notification-box">
        
</div>
<?php include 'includes/main-scripts.php'; ?>
<script src="js/scripts.js"></script>
<script src="js/profile.js"></script>
<script>
    cargarEncuestas();
</script>
</body>
</html>