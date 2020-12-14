<!DOCTYPE html>
<html lang="en">
<head>
<title>MooTics - Cambiar contraseña</title>
	<?php include 'includes/head.php'; ?>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-md-8 col-lg-4">
            <div class="p-3 mb-3 bg-white rounded shadow-sm border border-danger" id="panel">
                <h5 class="text-center">Eliminar usuario</h5>
                <hr>
                <form id="form">
                    <div class="from-group mb-2">
                        <label for="pass">Contraseña:</label>
                        <input class="form-control" type="password" name="pass" id="pass" required>
                    </div>
                    <hr>
                    <p class="text-center">Al dar de baja tu usuario se borrarán todas tus encuestas creadas</p>
                    <hr>
                    <button class="btn btn-danger btn-sm" id="btn-submit">Eliminar</button>
                    <a class="btn btn-secondary btn-sm float-right" href="profile.php">Cancelar</a>
                </form>               
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php include 'includes/message-box.php' ?>

<?php include 'includes/main-scripts.php'; ?>
<script src="js/deleteUser.js"></script>
</body>
</html>