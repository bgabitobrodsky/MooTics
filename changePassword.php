<?php 
    session_start();
    if(!isset($_SESSION["user-id"]))
        header("Location: ./login.php");
    else
?>
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
            <div class="p-3 mb-3 bg-white rounded shadow-sm border" id="panel">
                <h5 class="text-center">Cambiar contraseña</h5>
                <hr>
                <form id="form">
                    <div class="from-group mb-2">
                        <label for="current-pass">Contraseña actual:</label>
                        <input class="form-control" type="password" name="current-pass" id="current-pass" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="show-pass">
                        <label class="form-check-label" for="show-pass"><small>Mostrar contraseña</small></label>
                    </div>
                    <hr>
                    <div class="from-group mb-2">
                        <label for="new-pass">Nueva contraseña:</label>
                        <input class="form-control" type="password" name="new-pass" id="new-pass" required>
                    </div>
                    <div class="from-group mb-2">
                        <label for="rep-pass">Repita contraseña:</label>
                        <input class="form-control" type="password" name="rep-pass" id="rep-pass" required>
                    </div>
                    
                    <hr>
                    <button class="btn btn-primary btn-sm" id="btn-submit">Cambiar</button>
                    <a class="btn btn-secondary btn-sm float-right" href="profile.php">Cancelar</a>
                </form>               
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php include 'includes/message-box.php' ?>
<?php include 'includes/footer.php'; ?>

<?php include 'includes/main-scripts.php'; ?>
<script src="js/changePassword.js"></script>
</body>
</html>