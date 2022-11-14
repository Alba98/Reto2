/* SQL USUARIO */
CREATE TABLE `USUARIO` (
  `id_usu` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50)NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `contrasenia` varchar(20) NOT NULL,
  `imagen` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`id_usu`),
  ADD UNIQUE KEY `email` (`email`);
  
ALTER TABLE `USUARIO`
  MODIFY `id_usu` int NOT NULL AUTO_INCREMENT;
COMMIT;

/* SQL CATEGORIA */
CREATE TABLE `CATEGORIA` (
  `id_cat` int NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `CATEGORIA`
  ADD PRIMARY KEY (`id_cat`);

ALTER TABLE `CATEGORIA`
  MODIFY `id_cat` int NOT NULL AUTO_INCREMENT;
COMMIT;

/* SQL PREGUNTA */
CREATE TABLE `PREGUNTA` (
  `id_preg` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `detalle` text NOT NULL,
  `archivo` longblob COMMENT 'subir archivo',
  `id_cat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `PREGUNTA`
  ADD PRIMARY KEY (`id_preg`),
  ADD KEY `id_cat` (`id_cat`);

ALTER TABLE `PREGUNTA`
  MODIFY `id_preg` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `PREGUNTA`
  ADD CONSTRAINT `PREGUNTA_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `CATEGORIA` (`id_cat`);

/* SQL RESPUESTA */
CREATE TABLE `RESPUESTA` (
  `id_res` int NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `RESPUESTA`
  ADD PRIMARY KEY (`id_res`);
  
ALTER TABLE `RESPUESTA`
  MODIFY `id_res` int NOT NULL AUTO_INCREMENT;
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

ALTER TABLE `PREGUNTAR`
  MODIFY `id_preguntar` int NOT NULL AUTO_INCREMENT;

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

/* INSERTAR DATOS BASE */
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Informatica');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Medicina');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Ingenieria');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Jardineria');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Panaderia');

INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Pedro','Gonzalez','pedro@gmail.com','pedro');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Pepe','Fernandez','pepe@gmail.com','pepe');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Angel','Rodriguez','angel@gmail.com','angel');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Mauro','Arambarri','mauro@gmail.com','mauro');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Kike','Garcia','kike@gmail.com','kike');

INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Es correcto decir «yo y Santiago» o debemos decir «Santiago y yo»?','En una enumeración referida a personas, se aconseja situar el pronombre yo al final por razones de cortesía, pero no es lingüísticamente incorrecto que aparezca en primer lugar.','1');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Se escribe «a gusto» o «agusto»?','Esta expresión, que significa ‘cómodamente’, ‘con gusto o placer’ o ‘según el gusto o deseo de alguien’, se escribe siempre en dos palabras: a gusto. No se considera válida la grafía agusto.','2');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Cuál es la fórmula de saludo más adecuada, «buen día» o «buenos días»?','Como saludo matutino, la fórmula generalmente empleada en todo el ámbito hispanohablante es buenos días. Esta fórmula, única usada en España, alterna en el español de América con buen día, que está sobre todo extendida en el área rioplatense (Argentina, Paraguay y Uruguay).','3');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Se escribe «no te rayes» o «no te ralles»?','El verbo que se usa en el habla coloquial juvenil con el sentido de ‘trastornar(se), volver(se) loco’ es rayar(se): No te rayes; Me estás rayando. El verbo rallar significa ‘desmenuzar algo con el rallador’: Necesito que me ralles un poco de queso para la lasaña.','4');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Se escribe «Eres muy muy cruel» o «Eres muy, muy cruel»?','Construcciones como esta, en las que se duplica un elemento para aportar énfasis a lo expresado, se escriben sin coma: Eres muy muy cruel; Me gusta el café café; Hace mucho mucho tiempo.','5');

INSERT INTO `RESPUESTA`(`descripcion`) VALUES ('El burro delante para que no se espante. Con este dicho u otros similares se suele censurar a quien, en una enumeración, se nombra a sí mismo en primer lugar, gesto que ya parecía descortés en tiempos de Gonzalo Correas: «Los arrieros siempre echan los asnos delante».');
INSERT INTO `RESPUESTA`(`descripcion`) VALUES ('No, no es incorrecto ni lo ha sido nunca, aunque las normas de urbanidad aconsejen mencionar primero al otro. De hecho, no es nada difícil encontrar, en prestigiosos autores de todas las épocas, ejemplos en los que el pronombre que designa al hablante es el primero de una serie, larga o corta, de elementos coordinados.');
INSERT INTO `RESPUESTA`(`descripcion`) VALUES ('Hay ocasiones, incluso, donde el orden adecuado viene determinado por el contexto y puede ser relevante no citarse en último lugar. Si alguien nos dice Las primeras en llegar a la meta fuimos yo, Eva y Ana, interpretaremos que nuestra interlocutora ha ganado la carrera; si se cita en segundo lugar, lo lógico es pensar que ha llegado en segunda posición. ');
INSERT INTO `RESPUESTA`(`descripcion`) VALUES ('Con los pronombres del plural parece que la libertad es mayor: resulta más natural decir nosotros y ellos que a la inversa, en lo que quizá influyan razones rítmicas o prosódicas. Por otra parte, si entre los elementos coordinados aparecen entes no animados, la norma de cortesía se deshace y lo normal es que la persona figure en primer lugar.');
INSERT INTO `RESPUESTA`(`descripcion`) VALUES ('Por tanto, ni las reglas linguísticas ni las de urbanidad se conculcan en ejemplos como los siguientes, en los que sería raro que el pronombre de primera persona apareciera en un lugar distinto al que ocupa: «¡Oh, mal haya yo y todo mi linaje»');

INSERT INTO `PREGUNTAR`(`id_usu`, `id_preg`) VALUES (1,1);
INSERT INTO `PREGUNTAR`(`id_usu`, `id_preg`) VALUES (2,2);
INSERT INTO `PREGUNTAR`(`id_usu`, `id_preg`) VALUES (3,3);
INSERT INTO `PREGUNTAR`(`id_usu`, `id_preg`) VALUES (4,4);
INSERT INTO `PREGUNTAR`(`id_usu`, `id_preg`) VALUES (5,5);

INSERT INTO `RESPONDER`(`id_usu`, `id_res`) VALUES (1,1);
INSERT INTO `RESPONDER`(`id_usu`, `id_res`) VALUES (2,2);
INSERT INTO `RESPONDER`(`id_usu`, `id_res`) VALUES (3,3);
INSERT INTO `RESPONDER`(`id_usu`, `id_res`) VALUES (4,4);
INSERT INTO `RESPONDER`(`id_usu`, `id_res`) VALUES (5,5);