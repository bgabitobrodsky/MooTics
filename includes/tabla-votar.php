<div class="col"></div>
<div class="col-lg-6 col-md-8">
    <form action="php/votar.php" method="POST">
        <div class="panel">
            <div class="panel-header">
                <h3 class="pregunta"><?php echo $this->datos["pregunta"];?></h3>
                <i class="far fa-question-circle fa-3x"></i>
            </div>
            <div class="panel-body">
            <input type="hidden" name="id_encuesta" id="id_encuesta" value="<?php echo $this->datos["id"]?>">
            <?php foreach ($this->datos["opciones"] as $i => $op) { ?>
                <div class="fila-opcion">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-11 p-0">
                                <p class="opcion"><?php echo $op["opcion"]?></p>
                            </div>
                            <div class="col-1 d-flex align-items-center p-0 pl-2">
                                <label class="content-input">
                                    <input type="radio" name="opcion" id="<?php echo $op["id"]?>" value="<?php echo $op["id"]?>" required>
                                    <i></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                   
                </div>
            <?php }?>
            </div>
            <div class="panel-footer">
                <div class="text-center w-100">
                    <input type="submit" class="btn btn-dark" value="Enviar">
                </div>
            </div>
        </div>
    </form>
    <div class="alert alert-info" role="alert">
        <h5>Comparte este link para acceder a la encuesta:</h5>    
        <div class="link-box">
            <a id='link' href="?e=<?php echo $this->datos['id']?>">
                <?php echo $this->url?>
            </a>
            <button class="btn btn-sm btn-primary btn-copy-link" data-toggle="tooltip" title="Copiar"><i class="far fa-clipboard text-white"></i></button>
        </div>
    </div>
</div>
<div class="col"></div>