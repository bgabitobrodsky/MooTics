<div class="col"></div>
<div class="col-lg-6 col-md-8">
    <div class="panel">
        <div class="panel-header">
            <h3 class="pregunta"><?php echo $this->datos["pregunta"]?></h3>
            <i class="far fa-question-circle fa-3x"></i>
        </div>
        <div class="panel-body">
        <?php $total = max(totalDeVotos($this->datos["id"])["votos"],1);
        foreach ($this->datos["opciones"] as $i => $op){?>
            <div class="fila-opcion">
                <p class="opcion"><?php echo $op["opcion"]?></p>
                <p><b><?php echo $op["votos"]?></b></p>
                <div class="progress op-progress">
                    <div class="progress-bar bg-<?php echo getOpcionColor($i); ?>" role="progressbar" style="width: <?php echo ($op["votos"] * 100 / $total) ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            
        <?php }?>
        </div>
    </div>
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