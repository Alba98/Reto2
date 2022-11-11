/* SQL USUARIO */
CREATE TABLE `USUARIO` (
  `id_usu` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `contrasenia` varchar(20) NOT NULL,
  `imagen` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/* SQL RESPONDER */
CREATE TABLE USUARIO (
 	id_usu   int(10) NOT AUTO_INCREMENT,
 	id_res   int(10) ,
  nombre varchar(50),
  apellidos varchar(50),
  email varchar(30) UNIQUE NOT NULL,
  contrasenia varchar(20),
  imagen longblob NULL
    
);

ALTER TABLE USUARIO
  ADD PRIMARY KEY (id_usu),
  ADD UNIQUE KEY email (email);
  
ALTER TABLE USUARIO
  MODIFY id_usu int NOT NULL AUTO_INCREMENT;
COMMIT;

/* SQL CATEGORIA */
CREATE TABLE `CATEGORIA` (
  `id_cat` int NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE CATEGORIA
  ADD PRIMARY KEY (id_cat);

ALTER TABLE CATEGORIA
  MODIFY id_cat int NOT NULL AUTO_INCREMENT;
COMMIT;

/* SQL PREGUNTA */
CREATE TABLE PREGUNTA (
  id_preg int NOT NULL,
  titulo varchar(40) NOT NULL,
  detalle text NOT NULL,
  archivo longblob COMMENT 'subir archivo',
  id_cat int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE PREGUNTA
  ADD PRIMARY KEY (id_preg),
  ADD KEY id_cat (id_cat);

ALTER TABLE PREGUNTA
  MODIFY id_preg int NOT NULL AUTO_INCREMENT;

ALTER TABLE PREGUNTA
  ADD CONSTRAINT PREGUNTA_ibfk_1 FOREIGN KEY (id_cat) REFERENCES CATEGORIA (id_cat);

/* SQL RESPUESTA */
CREATE TABLE `RESPUESTA` (
  `id_res` int NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE RESPUESTA
  ADD PRIMARY KEY (id_res);
  
ALTER TABLE RESPUESTA
  MODIFY id_res int NOT NULL AUTO_INCREMENT;
COMMIT;

/* SQL PREGUNTAR */
CREATE TABLE PREGUNTAR (
  id_preguntar int(10),
 	id_usu    int(10),
 	id_preg   int(10),

  CONSTRAINT id_usu_fk FOREIGN KEY (id_usu)
	REFERENCES USUARIO(id_usu) ON DELETE CASCADE,
	CONSTRAINT  id_preg_fk FOREIGN KEY (id_preg)
	REFERENCES PREGUNTA(id_preg) ON DELETE CASCADE
);

ALTER TABLE `PREGUNTAR`
  ADD PRIMARY KEY (`id_preguntar`);

/* SQL RESPONDER */
CREATE TABLE RESPONDER (
  cod_res   int(10) PRIMARY KEY ,
 	id_usu    int(10) ,
 	id_res   int(10) ,
  CONSTRAINT res_usu_fk FOREIGN KEY (id_usu)
				REFERENCES USUARIO(id_usu) ON DELETE CASCADE,
	CONSTRAINT  id_res_fk FOREIGN KEY (id_res)
				REFERENCES RESPUESTA( id_res) ON DELETE CASCADE
);

ALTER TABLE `RESPONDER`
  MODIFY `cod_res` int NOT NULL AUTO_INCREMENT;
COMMIT;
