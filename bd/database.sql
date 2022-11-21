/* SQL USUARIO */
CREATE TABLE `USUARIO` (
  `id_usu` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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
  `nombre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `CATEGORIA`
  ADD PRIMARY KEY (`id_cat`);

ALTER TABLE `CATEGORIA`
  MODIFY `id_cat` int NOT NULL AUTO_INCREMENT;
COMMIT;

/* SQL PREGUNTA */
CREATE TABLE `PREGUNTA` (
  `id_preg` int NOT NULL,
  `titulo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `detalle` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `archivo` longblob COMMENT 'subir archivo',
  `visto` INT NULL DEFAULT 0,
  `id_cat` int NOT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `PREGUNTA`
  ADD PRIMARY KEY (`id_preg`),
  ADD KEY `id_cat` (`id_cat`);

ALTER TABLE `PREGUNTA` 
  ADD `fecha` DATETIME NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `PREGUNTA`
  MODIFY `id_preg` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `PREGUNTA`
  ADD CONSTRAINT `PREGUNTA_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `CATEGORIA` (`id_cat`);

/* SQL RESPUESTA */
CREATE TABLE `RESPUESTA` (
  `id_res` int NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_preg` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `RESPUESTA`
    ADD CONSTRAINT res_idpreg_fk
    FOREIGN KEY (`id_preg`)
    REFERENCES `PREGUNTA`(`id_preg`);

ALTER TABLE `RESPUESTA`
  ADD PRIMARY KEY (`id_res`);
  
ALTER TABLE `RESPUESTA`
  MODIFY `id_res` int NOT NULL AUTO_INCREMENT;
COMMIT;

/* SQL PREGUNTAR */
CREATE TABLE PREGUNTAR (
  cod_preg int(10),
  id_usu    int(10),
  id_preg   int(10),

  CONSTRAINT id_usu_fk FOREIGN KEY (id_usu)
  REFERENCES USUARIO(id_usu) ON DELETE CASCADE,
  CONSTRAINT  id_preg_fk FOREIGN KEY (id_preg)
  REFERENCES PREGUNTA(id_preg) ON DELETE CASCADE
);

ALTER TABLE `PREGUNTAR`
  ADD PRIMARY KEY (`cod_preg`);

ALTER TABLE `PREGUNTAR`
  MODIFY `cod_preg` int NOT NULL AUTO_INCREMENT;

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

CREATE TABLE VOTAR (
  id_usu    int(10),
  id_res   int(10),
  CONSTRAINT vot_usu_fk FOREIGN KEY (id_usu)
        REFERENCES USUARIO(id_usu) ON DELETE CASCADE,
  CONSTRAINT  id_vot_fk FOREIGN KEY (id_res)
        REFERENCES RESPUESTA( id_res) ON DELETE CASCADE,
  PRIMARY KEY (id_usu, id_res) 
);

CREATE TABLE GUSTAR (
  id_usu    int(10) ,
  id_preg   int(10) ,
  CONSTRAINT gust_usu_fk FOREIGN KEY (id_usu)
        REFERENCES USUARIO(id_usu) ON DELETE CASCADE,
  CONSTRAINT  id_gust_fk FOREIGN KEY (id_preg)
        REFERENCES PREGUNTA( id_preg) ON DELETE CASCADE,
  PRIMARY KEY (id_usu, id_preg)       
);



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
INSERT INTO `USUARIO`(`nombre`, `email`, `contrasenia`) VALUES ('Albatxu', 'albatxu@gmail.com', 'Hola1234');

INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Es correcto decir "yo y Santiago" o debemos decir "Santiago y yo"?','En una enumeración referida a personas, se aconseja situar el pronombre yo al final por razones de cortesía, pero no es lingüísticamente incorrecto que aparezca en primer lugar.','1');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Se escribe "a gusto" o "agusto"?','Esta expresión, que significa ‘cómodamente’, ‘con gusto o placer’ o ‘según el gusto o deseo de alguien’, se escribe siempre en dos palabras: a gusto. No se considera válida la grafía agusto.','2');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Cuál es la fórmula de saludo más adecuada, "buen día" o "buenos días"?','Como saludo matutino, la fórmula generalmente empleada en todo el ámbito hispanohablante es buenos días. Esta fórmula, única usada en España, alterna en el español de América con buen día, que está sobre todo extendida en el área rioplatense (Argentina, Paraguay y Uruguay).','3');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Se escribe "no te rayes" o "no te ralles"?','El verbo que se usa en el habla coloquial juvenil con el sentido de ‘trastornar(se), volver(se) loco’ es rayar(se): No te rayes; Me estás rayando. El verbo rallar significa ‘desmenuzar algo con el rallador’: Necesito que me ralles un poco de queso para la lasaña.','4');
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`) VALUES ('¿Se escribe "Eres muy muy cruel" o "Eres muy, muy cruel"?','Construcciones como esta, en las que se duplica un elemento para aportar énfasis a lo expresado, se escriben sin coma: Eres muy muy cruel; Me gusta el café café; Hace mucho mucho tiempo.','5');

INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('El burro delante para que no se espante. Con este dicho u otros similares se suele censurar a quien, en una enumeración, se nombra a sí mismo en primer lugar, gesto que ya parecía descortés en tiempos de Gonzalo Correas: "Los arrieros siempre echan los asnos delante".',1);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('No, no es incorrecto ni lo ha sido nunca, aunque las normas de urbanidad aconsejen mencionar primero al otro. De hecho, no es nada difícil encontrar, en prestigiosos autores de todas las épocas, ejemplos en los que el pronombre que designa al hablante es el primero de una serie, larga o corta, de elementos coordinados.',1);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('Hay ocasiones, incluso, donde el orden adecuado viene determinado por el contexto y puede ser relevante no citarse en último lugar. Si alguien nos dice Las primeras en llegar a la meta fuimos yo, Eva y Ana, interpretaremos que nuestra interlocutora ha ganado la carrera; si se cita en segundo lugar, lo lógico es pensar que ha llegado en segunda posición. ',2);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('Con los pronombres del plural parece que la libertad es mayor: resulta más natural decir nosotros y ellos que a la inversa, en lo que quizá influyan razones rítmicas o prosódicas. Por otra parte, si entre los elementos coordinados aparecen entes no animados, la norma de cortesía se deshace y lo normal es que la persona figure en primer lugar.',3);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('Por tanto, ni las reglas linguísticas ni las de urbanidad se conculcan en ejemplos como los siguientes, en los que sería raro que el pronombre de primera persona apareciera en un lugar distinto al que ocupa: "¡Oh, mal haya yo y todo mi linaje"',4);

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

/* VISTA PARA LA VISUALIZACIÓN PREGUNTAS */
CREATE VIEW vistaPreguntas AS
SELECT u.nombre "usuario", p.titulo "titulo", c.nombre "categoria", p.fecha "fecha", p.id_preg "id_preg", p.detalle "detalle", p.visto "vistos"
FROM USUARIO u, PREGUNTA p, CATEGORIA c, PREGUNTAR pr
WHERE u.id_usu = pr.id_usu
AND p.id_cat = c.id_cat
AND p.id_preg = pr.id_preg;

/* VISTA PARA LA VISUALIZACIÓN DE PREGUNTAS */
CREATE VIEW vistaRespuestas AS
SELECT u.nombre "usuario", r.descripcion "descripcion", r.id_res "id_res", p.id_preg "id_preg"
FROM USUARIO u, RESPUESTA r, RESPONDER rr, PREGUNTA p
WHERE u.id_usu = rr.id_usu
AND r.id_res = rr.id_res
AND p.id_preg = r.id_preg;

/* VISTA PARA CONSEGUIR CANTIDAD DE RESPUESTAS DE UNA PREGUNTA */
CREATE VIEW countRespuestas AS 
SELECT p.id_preg, IFNULL(COUNT(r.id_preg),0) "respuestas"
FROM PREGUNTA p
LEFT JOIN RESPUESTA r ON p.id_preg = r.id_preg
GROUP BY p.id_preg;

/* VISTA PARA CONSEGUIR CANTIDAD LIKES DE UNA PREGUNTA */
CREATE VIEW countLikes AS 
SELECT p.id_preg, IFNULL(COUNT(g.id_preg),0) "like"
FROM PREGUNTA p
LEFT JOIN GUSTAR g ON g.id_preg = p.id_preg
GROUP BY p.id_preg;

/* VISTA PARA CONSEGUIR CANTIDAD VOTOS DE UNA RESPUESTA */
CREATE VIEW countVotos AS 
SELECT r.id_res, IFNULL(COUNT(v.id_res),0) "voto"
FROM RESPUESTA r
LEFT JOIN VOTAR v ON v.id_res = r.id_res
GROUP BY r.id_res;