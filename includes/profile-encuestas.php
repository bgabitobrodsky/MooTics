<div class="p-3 bg-white rounded shadow-sm border">
	<h4 class="mt-2 mb-4">Encuestas creadas</h4>
	<?php 
	$encuestas = getEncuestas($_SESSION["user-id"]);
	if(mysqli_num_rows($encuestas)>0){
		while($encuesta = mysqli_fetch_assoc($encuestas)){
			$e = new Encuesta($encuesta["id"]);
			?>
			<div class="encuesta border rounded bg-secondary text-white d-flex justify-content-between mb-3">
				<h6 class="text-white p-3"><?php echo $encuesta['descripcion'] ?></h6>
				<div class="e-buttons d-flex">
					<button class="btn btn-dark rounded-0" data-toggle="modal" data-target="#e<?php echo $encuesta["id"]?>"><i class="fas fa-eye text-white"></i></button>
					<button class="btn btn-dark rounded-0 btn-pausa" target="<?php echo $encuesta["id"] ?>">
						<?php if($encuesta['paused']){?>
							<i class="fas fa-play text-white"></i>
						<?php }else{ ?>
							<i class="fas fa-pause text-white"></i>
						<?php } ?>
					</button>
					<button class="btn btn-danger rounded-0 btn-ask-delete"><i class="fas fa-trash"></i></button>
					<button class="btn btn-danger rounded-0 btn-delete" target="<?php echo $encuesta["id"] ?>"><i class="fas fa-check"></i></button>
				</div>
			</div>
			
		<?php 
		$e->modal();	
	}
	}else{ ?>      
		<h5>¡No has creado ninguna encuesta!</h5>
	<?php } ?>
</div>