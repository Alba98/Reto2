<?php
    require ('../db_functions.php');

    $dbh = connect();

    //Funciones
    function api_getPreguntas(){
        global $dbh;

        $preguntas = getVistaPreguntas($dbh);
        foreach ($preguntas as &$pregunta) { //pasamos por referencia para modificar cada elemento del array
            // obtengo el id de cada pregunta
            $id_preg = $pregunta['id_preg'];

            // obtengo los likes por cada pregunta
            $likes = countLikes($dbh, $id_preg)->like;

            // a cada pregunta, meterle su cantidad de likes
            // hay que poder modificar la pregunta para que esta linea tenga sentido
            $pregunta['likes'] = $likes;

            // obtengo las respuestas por cada pregunta
            $respuestas = countRespuestas($dbh, $id_preg)->respuestas;
            $pregunta['respuestas'] = $respuestas;
        }

        return $preguntas;
    }

    //Funciones
    function api_getPregunta(){
        global $dbh;

        $preguntas = getVistaPregunta($dbh, $_GET['id']);
        foreach ($preguntas as &$pregunta) { 
            $id_preg = $pregunta['id_preg'];

            // obtengo los likes por cada pregunta
            $likes = countLikes($dbh, $id_preg)->like;
            $pregunta['likes'] = $likes;
        }

        return $preguntas;
    }

    function api_getRespuestas(){
        global $dbh;

        $preguntas = getVistaRespuestas($dbh, $_GET['id']);
        foreach ($preguntas as &$pregunta) { 
            $id_res = $pregunta['id_res'];

            // obtengo los votos de cada pregunta
            $votos = countVotos($dbh, $id_res)->voto;
            $pregunta['votos'] = $votos;
        }

        return $preguntas;
    }

    function api_actualizarVisto(){
        global $dbh;
        updateVisto($dbh, $_GET["id"]);
    }

    function api_actualizarLike(){
        global $dbh;
        insertarLike($dbh, $_GET["id"]);
    }

    function api_borrarLike(){
        global $dbh;
        borrarLike($dbh, $_GET["id"]);
    }

    function api_actualizarVoto(){
        global $dbh;
        insertarVoto($dbh, $_GET["id"]);
    }

    function api_borrarVoto(){
        global $dbh;
        borrarVoto($dbh, $_GET["id"]);
    }

    function api_getCategorias(){
        global $dbh;
        return getAll($dbh, "CATEGORIA");;
    }

    function api_enviarPregunta(){
        global $dbh;
        if (isset($_GET['titulo']) && isset($_GET['categoria']) && isset($_GET['detalle']) ) { // && isset($_GET['archivo'])
            if ($_GET['titulo'] != "" && $_GET['categoria'] != "" && $_GET['detalle'] != "") {
                $data = array (
                    "titulo" => $_GET['titulo'],
                    "detalle" => $_GET['detalle'],
                    // "archivo" => $_GET['archivo'],
                    "categoria" => $_GET['categoria']
                );
                insertPregunta($dbh, $data);
            }
        }       
    }

    function api_enviarRespuesta(){
        global $dbh;
        if (isset($_GET['id_preg']) && isset($_GET['detalle']) ) { // && isset($_GET['archivo'])
            if ($_GET['id_preg'] != "" && $_GET['detalle'] != "") {
                $data = array (
                    "id_preg" => $_GET['id_preg'],
                    "detalle" => $_GET['detalle'],
                    // "archivo" => $_GET['archivo']
                );
                insertRespuesta($dbh, $data);
            }
        }  
    }
?>