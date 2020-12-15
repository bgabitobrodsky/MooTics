<div class="col"></div>
	<div class="col-lg-6 col-md-8">
		<form action="php/crear.php" method="POST" id="form-crear">
			<div class="panel">
				<div class="panel-header">
					<input name="pregunta" type="text" class="pregunta" placeholder="Escribe tu pregunta"><i class="far fa-question-circle fa-3x"></i>
				</div>
				<div class="panel-body" id="panel-body">
					<div class="fila-opcion">
						<input name="opciones[]" type="text" class="opcion" placeholder="1.">
					</div>
					<div class="fila-opcion">
						<input name="opciones[]" type="text" class="opcion" placeholder="2.">
					</div>				
				</div>
				<div class="fila-mas" id="fila-mas">
						<i class="fas fa-plus-circle fa-2x" id="agregar-opcion" onclick="agregarOpcion()"></i>
					</div>
				<div class="panel-footer">
					<input type="submit" class="btn btn-primary" value="Crear" id="btn-crear"> <input type="reset" class="btn btn-secondary" value="Eliminar">
				</div>
			</div>
		</form>
	</div>
<div class="col"></div>