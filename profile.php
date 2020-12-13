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
        <div class="col-lg-4">
            <div class="p-3 mb-3 bg-white rounded shadow-sm border">
                <h3>Perfil</h3>
                <hr>
                <p><b>Usuario:</b> <?php echo $_SESSION["user"] ?></p>
                <p><b>Mail:</b> <?php echo $_SESSION["user-mail"] ?></p>
                <hr>

                <div class="d-flex justify-content-between">
                    <a href="changePassword.php" class="btn btn-sm btn-primary">Cambiar contraseña</a>
                    <a href="deleteUser.php" class="btn btn-sm btn-danger">Eliminar usuario</a>
                </div>

            </div>
        </div>
        <div class="col-lg-8">
            <div class="pt-3 pl-3 pr-3 bg-white rounded shadow-sm border">
                <h3>Encuestas creadas</h3>
                <hr>
                <div id="encuestas-container">
                    <div class="text-center"><div class="spinner-border spinner-border-lg text-secondary my-3" role="status"><span class="sr-only">Loading...</span></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/modal-encuesta.php';?>

<?php include 'includes/message-box.php'?>
<?php include 'includes/main-scripts.php'; ?>
<script src="js/profile.js"></script>
</body>
</html>