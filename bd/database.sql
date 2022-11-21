/* SQL USUARIO */
CREATE TABLE `USUARIO` (
  `id_usu` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contrasenia` varchar(20) NOT NULL,
  `imagen` longblob
);


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
);

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
);

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
);

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
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Aviacion');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Dirigibles');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Aeroespacio');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Parques aeronauticos');
INSERT INTO `CATEGORIA`(`nombre`) VALUES ('Seguridad Aerea');

INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Pedro','Gonzalez','pedro@gmail.com','pedro');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Pepe','Fernandez','pepe@gmail.com','pepe');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Angel','Rodriguez','angel@gmail.com','angel');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Mauro','Arambarri','mauro@gmail.com','mauro');
INSERT INTO `USUARIO`(`nombre`, `apellidos`, `email`, `contrasenia`) VALUES ('Kike','Garcia','kike@gmail.com','kike');
INSERT INTO `USUARIO`(`nombre`, `email`, `contrasenia`) VALUES ('Albatxu', 'albatxu@gmail.com', 'Hola1234');

INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`,`visto`) VALUES ('¿Qué es la regla Paretto y dónde podría aplicarse este princicpio?','No había conocido esta ley hasta el día de hoy, pero imagino que su aplicación en la meteorología aeronáutica tiene que ver con la utilización de una escala meteorológica menor (mesoescala e incluso microescala) que son aquellas escalas en la que están los fenómenos que afectan a la aeronavegación (tormentas, downburst, microburst, etc). Tienen una extensión y una duración menor que la escala sinóptica (serían el 20 de esa ley, pero generarían el 80% de los problemas que afectan a la navegación aérea).','1',7);
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`,`visto`) VALUES ('¿Qué problemas puede causar una tormenta en los alrededores de un aeropuerto?','Un avión en la aproximación final puede encontrar una fuerte ascendencia debida a la parte exterior del torbellino horizontal creado por rebote del "downburst". Quizá la reacción del piloto sea la de bajar el morro del avión, lo cual no puede ser más desaconsejable, ya que inmediatamente se encontrará la intensa corriente descendente y con tal presentación del avión, las consecuencias pueden ser fatales.','2',31);
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`,`visto`) VALUES ('¿Qué significa VNE? ¿Qué pasa si no se cumple?','No debe confundirse el "downburst" con el tornado; son fenómenos de extensión parecida y a veces efectos similares, pero hay una diferencia esencial: en el "downburst" las corrientes son descendentes, mientras que en el tornado se combinan ascendentes y en espiral. Acaso para la pequeña aviación revistan especial peligrosidad los procedentes de las tormentas secas por ser mas difíciles de localizar y en buena parte de los casos casi imposible identificar visualmente.','3',21);
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`,`visto`) VALUES ('¿Por qué es importante el pronóstico del viento en un aeropuerto?','La turbulencia por cortante de viento (o cizalladura del viento) se produce cuando hay un cambio brusco en la velocidad y/o dirección del viento. A grandes alturas este tipo de turbulencia se denomina CAT (Turbulencia en aire claro) y se asocia en general a la corriente en chorro. No se asocia a nubosidad de allí su nombre y por lo tanto no puede reconocerse a simple vista.','4',56);
INSERT INTO `PREGUNTA`(`titulo`, `detalle`, `id_cat`,`visto`) VALUES ('¿Qué significa "alternate"?','La turbulencia mecánica se debe a los torbellinos que se generan en el aire al chocar con diferentes obstáculos en la superficie. Puede verse incrementada en el caso de aire inestable y también debido a la presencia de una barrera orográfica. Las ondas de montaña generan turbulencia moderada o severa y su manifestación visible son los altocúmulos lenticulares que se forman en esas ondas.','5',3);

INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('La regla o ley de Paretto (la Regla del 80/20) significa que el 20% de algo es esencial y el 80% es trivial. El 20% de los defectos causan el 80% de los problemas, el 20% del trabajo consume el 80% del tiempo y los recursos. La regla del 80/20 también se aplica a las ventas (el 20% de los clientes produce el 80% de los beneficios; o el 20% de los vendedores realiza el 80% de las ventas) o a cualquier otra cosa (el 20% del diario trae el 80% de las noticias importantes, o que el 20% de los empleados causan el 80% de los problemas).',1);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('Las aeronaves que llegan o parten del aeropuerto podrían encontrarse con granizo, engelamiento, turbulencia e incluso en casos extremos con fuertes descendentes (microrráfagas o downburst: macroburst o microburst) que podrían tener graves consecuencias. Las llamadas en inglés "downburst" al llegar al suelo se extienden con violencia. No sólo se forman los temidos "downburst" en las fases de comienzo del estado de madurez de un proceso tormentoso, es decir, en el llamado "reventón" en muchos países de habla hispana, sino que también se pueden presentar en tormentas secas.',1);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('VNE es la velocidad de nunca exceder. Se marca con una línea roja en muchos indicadores de velocidad aérea y varía en cada aeronave. Exceder VNE da lugar a una pérdida de control e incluso puede producir fallas estructurales. No es seguro volar en o cerca de VNE en condiciones de turbulencia.',2);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('Cambios en la dirección o velocidad del viento tienen implicancias directas en las operaciones del aeródromo. De acuerdo a la dirección del viento se define qué cabecera de pista se empleará en las operaciones de despegue y aterrizaje. Además, las aeronaves tienen limitaciones respecto de la componente de viento cruzado (que a su vez varían si la pista está seca o mojada).',3);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('Significa alternativa, o aeropuerto de alternativa. En los planes de vuelo se establecen de antemano a qué aeropuertos se va a dirigir la aeronave en caso de que el aeropuerto de destino se encuentre cerrado o en caso de que la aeronave tenga algún problema y no pueda llegar al aeropuerto de destino. El aeropuerto de alternativa a seleccionar para cualquier destino,deberá garantizar con la mayor probabilidad de éxito el aterrizaje en caso que el aeropuerto de destino se encuentre bajo mínimos, contemplando las limitaciones de techo y visibilidad (no de distancia de vuelo) de la categoría que reviste el piloto.',4);
INSERT INTO `RESPUESTA`(`descripcion`,`id_preg`) VALUES ('Se usa el QNH. EL QNH es la presión al nivel del mar deducida de la existente en el aeródromo, considerando la atmósfera en condiciones estándar. La utilidad de esta presión de referencia se debe a que en las cartas de navegación y de aproximación a los aeródromos, las altitudes se indican respecto al nivel del mar. Con esta presión de referencia, al despegar o aterrizar el altímetro debería indicar la altitud real del aeródromo.',1);


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
INSERT INTO `RESPONDER`(`id_usu`, `id_res`) VALUES (2,6);

INSERT INTO `VOTAR`(`id_usu`,`id_res`) VALUES (1,1);
INSERT INTO `VOTAR`(`id_usu`,`id_res`) VALUES (2,1);
INSERT INTO `VOTAR`(`id_usu`,`id_res`) VALUES (3,1);
INSERT INTO `VOTAR`(`id_usu`,`id_res`) VALUES (1,2);
INSERT INTO `VOTAR`(`id_usu`,`id_res`) VALUES (1,3);
INSERT INTO `VOTAR`(`id_usu`,`id_res`) VALUES (2,2);

INSERT INTO `GUSTAR`(`id_usu`,`id_preg`) VALUES (1,1);
INSERT INTO `GUSTAR`(`id_usu`,`id_preg`) VALUES (2,3);
INSERT INTO `GUSTAR`(`id_usu`,`id_preg`) VALUES (2,4);
INSERT INTO `GUSTAR`(`id_usu`,`id_preg`) VALUES (4,2);
INSERT INTO `GUSTAR`(`id_usu`,`id_preg`) VALUES (3,1);

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