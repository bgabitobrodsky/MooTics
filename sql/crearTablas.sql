CREATE TABLE IF NOT EXISTS
	bd_encuestas.encuesta( 
    id VARCHAR(16) NOT NULL , 
    descripcion VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS
bd_encuestas.opcion( 
	id INT(11) NOT NULL AUTO_INCREMENT,
	id_encuesta VARCHAR(16) NOT NULL ,
	descripcion VARCHAR(255) NOT NULL , 
	PRIMARY KEY (id),
	FOREIGN KEY (id_encuesta) REFERENCES encuesta(id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS
bd_encuestas.voto(
	id_opcion INT(11) NOT NULL ,
    ip INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_opcion, ip),
    FOREIGN KEY (id_opcion) REFERENCES opcion(id)
) ENGINE = InnoDB;