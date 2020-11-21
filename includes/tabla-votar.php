<div class="col"></div>
<div class="col-lg-6 col-md-8">
    <?php if(isset($_SESSION["creada"])){
        unset($_SESSION["creada"]);?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  ¡Encuesta creada!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

    <?php } ?>
    <form action="php/votar.php" method="POST">
        <div class="panel">
            <div class="panel-header">
                <h3 class="pregunta"><?php echo $datos["pregunta"];?></h3>
                <i class="far fa-question-circle fa-3x"></i>
            </div>
            <div class="panel-body">
            <input type="hidden" name="id_encuesta" id="id_encuesta" value="<?php echo $id?>">
            <?php foreach ($datos["opciones"] as $i => $op) { ?>
                <div class="fila-opcion">
                    <p class="opcion"><?php echo $op["opcion"]?></p>
                    <label class="content-input">
                        <input type="radio" name="opcion" id="<?php echo $op["id"]?>" value="<?php echo $op["id"]?>" required>
                        <i></i>
                    </label>
                </div>
            <?php }?>
            </div>
            <div class="panel-footer">
                <input type="submit" class="btn btn-dark" value="Enviar">
            </div>
        </div>
    </form>
    <?php include 'includes/link-compartir.php';?>
</div>
<div class="col"></div>