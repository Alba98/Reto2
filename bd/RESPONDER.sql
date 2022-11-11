CREATE TABLE RESPONDER (
    cod_res   NUMBER(10) PRIMARY KEY ,
 	id_usu    NUMBER(10) ,
 	id_res   NUMBER(10) ,

    CONSTRAINT id_usu_fk FOREIGN KEY (id_usu)
				REFERENCES USUARIO(id_usu) ON DELETE CASCADE,
	CONSTRAINT  id_res_fk FOREIGN KEY (id_res)
				REFERENCES RESPUESTA( id_res) ON DELETE CASCADE
                
    );
