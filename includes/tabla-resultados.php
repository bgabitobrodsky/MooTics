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
foreach ($datos["opciones"] as $i => $op){?>
<div class="fila-opcion">
    <p class="opcion"><?php echo $op["opcion"]?></p>
    <p><b><?php echo $op["votos"]?></b></p>
</div>
<?php }?>

</div>
</div>
</form>
<?php include 'includes/link-compartir.php';?>

</div>
<div class="col"></div>