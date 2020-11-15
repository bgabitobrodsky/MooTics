SELECT
	opcion.id,
	opcion.descripcion,
    (SELECT count(*) FROM voto WHERE voto.id_opcion = opcion.id) votos
FROM opcion
WHERE opcion.id_encuesta = "5628b20f2173b46a"

