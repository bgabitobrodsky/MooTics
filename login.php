<?php
require_once 'php/consultas.php';
session_start();

if(isset($_SESSION['user-id'])){
    header('Location: ./');
}

$mostrarCrear = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MooTics - Login</title>
	<?php include 'includes/head.php'; ?>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <form action="php/ingresar.php" method="POST" class="col-md-6 p-3 bg-white mt-5 rounded shadow-sm border">
            <h3 class="text-center mb-3">Ingresar</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="user" id="user" placeholder="Usuario">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-dark w-100">
            </div>
                <small class="float-right">¿No tienes cuenta? <a href="#">Registráte</a></small>
        </form>
        <div class="col"></div>
    </div>
</div>
<?php include 'includes/message-box.php' ?>
<?php include 'includes/main-scripts.php'; ?>
</body>
</html>