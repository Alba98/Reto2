<?php
    session_start();
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

        $preguntas = getVistaPregunta($dbh);
        foreach ($preguntas as &$pregunta) { 
            $id_preg = $pregunta['id_preg'];

            // obtengo los likes por cada pregunta
            $likes = countLikes($dbh, $_GET["id"])->like;
            $pregunta['likes'] = $likes;
        }


        return $preguntas;
    }

    function api_getRespuestas(){
        global $dbh;

        $preguntas = getVistaRespuestas($dbh);
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
        updateVisto($dbh);
    }

    function api_actualizarLike(){
        global $dbh;
        insertarLike($dbh);
    }

    function api_borrarLike(){
        global $dbh;
        borrarLike($dbh);
    }

    function api_actualizarVoto(){
        global $dbh;
        insertarVoto($dbh);
    }

    function api_borrarVoto(){
        global $dbh;
        borrarVoto($dbh);
    }

    function api_getCategorias(){
        global $dbh;
        return getAll($dbh, "categoria");;
    }

    function api_enviarPregunta(){
        global $dbh;
        enviarPregunta($dbh);        
    }

    //Vamos a comprobar que lo que 
    $funcion = isset($_GET['funcion']) ? $_GET['funcion'] : null;

    //Cada respuesta que nos va a dar la API
    $respuesta = [];

    switch ($funcion) {
        case 'getPreguntas':
            $respuesta = api_getPreguntas();
            break;
        case 'getDetallesPregunta':
            $respuesta = api_getPregunta();
            break;
        case 'getRespuestas':
            $respuesta = api_getRespuestas();
            break;
        case 'actualizarVisto':
            api_actualizarVisto();
            break;
        case 'insertarLike':
            api_actualizarLike();
            break;
        case 'borrarLike':
            api_borrarLike();
            break;
        case 'insertarVoto':
            api_actualizarVoto();
            break;
        case 'borrarVoto':
            api_borrarVoto();
            break;
        case 'getCategorias':
            $respuesta = api_getCategorias();
            break;
        case 'enviarPregunta':
            api_enviarPregunta();
            break;
        default:
            break;
    }

    header('Content-Type', 'application/json');
    echo json_encode($respuesta);
?>