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
            <?php include 'includes/profile-encuestas.php' ?>
        </div>
    </div>
</div>




<?php include 'includes/message-box.php' ?>
<?php include 'includes/main-scripts.php'; ?>
<script src="js/scripts.js"></script>
<script src="js/profile.js"></script>
</body>
</html>