SELECT
	sum(votos) votos
from(
	SELECT
		(SELECT count(*) FROM voto WHERE voto.id_opcion = opcion.id) votos
	FROM opcion
	WHERE opcion.id_encuesta = "2e32806488b7ceb5"
) AS totales
