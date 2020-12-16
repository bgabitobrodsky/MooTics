<div class="col"></div>
	<div class="col-lg-6 col-md-8">
		<form action="php/crear.php" method="POST" id="form-crear">
			<div class="panel">
				<div class="panel-header">
					<input name="pregunta" type="text" class="pregunta" placeholder="Escribe tu pregunta"><i class="fas fa-question fa-2x"></i>
				</div>
				<div class="panel-body" id="panel-body-crear">
					<div class="fila-opcion">
						<input name="opciones[]" type="text" class="opcion" placeholder="1.">
					</div>
					<div class="fila-opcion">
						<input name="opciones[]" type="text" class="opcion" placeholder="2.">
					</div>
					<div class="fila-opcion">
						<input name="opciones[]" type="text" class="opcion" placeholder="3.">
					</div>
				</div>
				<div class="panel-footer">
					<div class="crear-config mb-3 d-flex justify-content-between align-items-center">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="public" value="true" id="public" checked <?php if(!isset($_SESSION["user-id"])) echo "disabled data-toggle='tooltip' title='Accede para crear encuestas privadas'";?>>
							<label class="form-check-label" for="public">
								Encuesta pública
							</label>							
						</div>
						<?php if(!isset($_SESSION["user-id"])){?>
						<small>Accede para crear encuestas privadas</small>
						<?php } ?>
					</div>
					<div class="d-flex w-100 justify-content-between">
						<input type="submit" class="btn btn-primary" value="Crear" id="btn-crear"> <input type="reset" class="btn btn-secondary" value="Eliminar">
					</div>
				</div>
			</div>
		</form>
	</div>
<div class="col"></div>