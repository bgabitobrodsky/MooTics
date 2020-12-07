<div class="col"></div>
        <div class="col-lg-6 col-md-8">
            <form action="resultados.php?e='.$id.'" method="POST">
                <div class="panel">
                    <div class="panel-header">
                        <h3 class="pregunta"><?php echo $datos["pregunta"]?></h3>
                        <i class="far fa-question-circle fa-3x"></i>
                    </div>
                    <div class="panel-body">
                    <?php
                    $total = max(totalDeVotos($id)["votos"],1);
                    foreach ($datos["opciones"] as $i => $op){?>
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
            </form>
<?php include 'includes/link-compartir.php';?>

</div>
<div class="col"></div>