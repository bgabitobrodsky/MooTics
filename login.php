<?php
require_once 'php/consultas.php';
session_start();

if(isset($_SESSION['user-id'])){
    header('Location: ./');
}
$page = "login";
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
        <form id="form-login" class="col-md-6 col-lg-4 p-3 bg-white mt-5 rounded shadow-sm border">
            <h3 class="text-center mb-3">Ingresar</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="user" id="user" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <button class="btn btn-dark w-100" id="btn-login">Ingresar</button>
            </div>
                <small class="float-right">¿No tienes cuenta? <a href="#" id="btn-to-register">Registráte</a></small>
        </form>

        <form id="form-register" class="col-md-6 col-lg-4 p-3 bg-white mt-5 rounded shadow-sm border" style="display:none">
            <h3 class="text-center mb-3">Registrar</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="user" id="reg-user" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="user" id="reg-mail" placeholder="Email" required>
            </div>
            <hr>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="reg-pass" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="rep-pass" placeholder="Repita la contraseña" required>
            </div>
            <div class="form-group">
                <button class="btn btn-dark w-100" id="btn-register">Registrar</button>
            </div>
                <small class="float-right">¿Ya tienes cuenta? <a href="#" id="btn-to-login">Ingresa aquí</a></small>
        </form>
        <div class="col"></div>
    </div>
</div>
<?php include 'includes/message-box.php' ?>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/main-scripts.php'; ?>
<script src="js/login.js"></script>
</body>
</html>