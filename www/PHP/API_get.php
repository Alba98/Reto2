<?php
    session_start(); // para poder acceder al id del usuario guardado en la sesion
    require ('./llamar_bd.php');

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
        case 'getPreguntasUsuario':
            $respuesta = api_GetPreguntasUsuario();
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
        case 'enviarRespuesta':
            api_enviarRespuesta();
            break;
        default:
            break;
    }

    //cada vez que se realice una accion actualizar las puntuaciones de los usuarios
    api_actualizarPuntuaciones();

    //cargar el header en formato JSON y implementarle el array de datos
    header('Content-Type', 'application/json');
    echo json_encode($respuesta);
?>