<div class="modal fade" id="e<?php echo $this->datos["id"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo $this->datos["pregunta"] ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-0">
			<?php			
			foreach ($this->datos["opciones"] as $i => $op){?>
				<div class="fila-opcion">
					<p class="opcion"><?php echo $op["opcion"]?></p>
					<p><b><?php echo $op["votos"]?></b></p>
					<div class="progress op-progress">
						<div class="progress-bar bg-<?php echo getOpcionColor($i); ?>" role="progressbar" style="width: <?php echo ($op["votos"] * 100 / $this->total) ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				
			<?php }?>
			<div class="alert alert-info m-0">
				<div class="link-box">
					<a id='link' href="index.php?e=<?php echo $this->datos['id']?>">
						<?php echo $this->url?>
					</a>
					<button class="btn btn-sm btn-primary btn-copy-link" data-toggle="tooltip" title="Copiar"><i class="far fa-clipboard text-white"></i></button>
				</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>