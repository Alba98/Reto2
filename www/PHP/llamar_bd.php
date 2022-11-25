<?php
    require ('../db_functions.php');

    //variable global con la conexion BBDD
    $dbh = connect();

    // funcion para obtner respuestas con filtros: siguiendo esta estructura 
    //
    // case orden
    //     if($categoria) {
    //         if($buscar)
    //             busqueda + categoria + orden
    //         else
    //             categoria + orden
    //     }
    //     else{
    //         if($buscar)
    //             busqueda + orden
    //         else
    //             orden
    //     }
    // break
    function api_getPreguntas(){
        global $dbh;

        $preguntas = [];

        $order = isset($_GET['order']) ? $_GET['order'] : null;
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
        $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : null;

        switch ($order) {
           
            case 'masVistas':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMasVistasCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMasVistasCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMasVistasBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMasVistas($dbh); 
                }
                break;
            case 'menosVistas':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMenosVistasCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMenosVistasCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMenosVistasBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMenosVistas($dbh); 
                }
                break;
            case 'masVotadas':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMasLikeCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMasLikeCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMasLikeBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMasLike($dbh); 
                }
                break;
            case 'menosVotadas':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMenosLikeCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMenosLikeCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMenosLikeBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMenosLike($dbh); 
                }
                break;
            case 'masRespuestas':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMasRespuestasCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMasRespuestasCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMasRespuestasBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMasRespuestas($dbh); 
                }
                break;
            case 'menosRespuestas':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMenosRespuestasCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMenosRespuestasCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMenosRespuestasBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMenosRespuestas($dbh); 
                }
                break;
            case 'masRecientes':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMasRecientesCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMasRecientesCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMasRecientesBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMasRecientes($dbh); 
                }
                break;
            case 'menosRecientes':
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasMenosRecientesCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasMenosRecientesCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasMenosRecientesBuscar($dbh, $buscar); //
                   else
                       $preguntas = getPreguntasMenosRecientes($dbh); 
                }
                break;
            default:
                if($categoria) {
                    if($buscar)
                        $preguntas = getPreguntasCategoriaBuscar($dbh, $categoria, $buscar);
                    else
                        $preguntas = getPreguntasCategoria($dbh, $categoria);
                }
                else {
                   if($buscar)
                       $preguntas = getPreguntasBuscar($dbh, $buscar);
                   else
                       $preguntas = getVistaPreguntas($dbh); 
                }
                break;
        }

        // $preguntas = getVistaPreguntas($dbh);

        return $preguntas;
    }

    // funcion para obtner las preguntas del usuario actual
    function api_GetPreguntasUsuario() {
        global $dbh;

        $preguntas = getVistaPreguntasPorUsuario($dbh, $_SESSION[ "id_usu"]);

        return $preguntas;
    }

    // funcion para obtner todas las preguntas
    function api_getPregunta(){
        global $dbh;

        $preguntas = getVistaPregunta($dbh, $_GET['id']);

        return $preguntas;
    }

    // funcion para obtner todas las respuestas
    function api_getRespuestas(){
        global $dbh;

        $preguntas = getVistaRespuestas($dbh, $_GET['id']);

        return $preguntas;
    }

    // funcion para anadir visto a una pregunta
    function api_actualizarVisto(){
        global $dbh;
        updateVisto($dbh, $_GET["id"]);
    }

    // funcion para anadir like a una pregunta
    function api_actualizarLike(){
        global $dbh;
        insertarLike($dbh, $_GET["id"]);
    }

    // funcion para borrar like a una pregunta
    function api_borrarLike(){
        global $dbh;
        borrarLike($dbh, $_GET["id"]);
    }

    // funcion para anadir voto a una respuesta
    function api_actualizarVoto(){
        global $dbh;
        insertarVoto($dbh, $_GET["id"]);
    }

    // funcion para borrar voto a una respuesta
    function api_borrarVoto(){
        global $dbh;
        borrarVoto($dbh, $_GET["id"]);
    }

    // funcion para obtener todas las categorias
    function api_getCategorias(){
        global $dbh;
        return getAll($dbh, "CATEGORIA");;
    }

    // funcion para insertar una pregunta
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

    // funcion para insertar una respuesta
    function api_enviarRespuesta(){
        global $dbh;
        if (isset($_GET['id_preg']) && isset($_GET['detalle']) ) { // && isset($_GET['archivo'])
            if ($_GET['id_preg'] != "" && $_GET['detalle'] != "") {
                $data = array (
                    "id_preg" => $_GET['id_preg'],
                    "detalle" => $_GET['detalle']
                    // "archivo" => $_GET['archivo']
                );
                insertRespuesta($dbh, $data);
            }
        }  
    }

    // funcion para actualizar la puntuacion de todos los usuarios
    function api_actualizarPuntuaciones() {
        global $dbh;
        $usuarios = getAll($dbh, "USUARIO");
        foreach ($usuarios as $usuario) { 
            api_actualizarPuntuacion($usuario->id_usu);
        }

    }

    // funcion para actualizar la puntuacion de un usuario concreto
    function api_actualizarPuntuacion($id_usuario) {
        global $dbh;
        $preguntas = getVistaPreguntasPorUsuario($dbh, $id_usuario);
        $respuestas = getVistaRespuestasPorUsuario($dbh, $id_usuario);

        //variables para el calculo
        $n_preguntas = 0;
        $n_likes = 0;
        $n_vistos = 0;
 
        $n_respuestas = 0;
        $n_votos = 0;
 
        foreach ($preguntas as $pregunta) { 
            $n_preguntas += 1;
            $n_likes += $pregunta->likes;
            $n_vistos += $pregunta->vistos;
        }
 
        foreach ($respuestas as $respuesta) { 
            $n_respuestas += 1;
            $n_votos += $respuesta->votos;
        }
 
        $puntuacion = 0;
 
        if($n_preguntas >= 5) $puntuacion += 1;
        if($n_vistos >= 10) $puntuacion += 1;
        if($n_likes >= 5) $puntuacion += 1;
 
        if($n_respuestas >= 5) $puntuacion += 1;
        if($n_votos >= 5) $puntuacion += 1;

        updatePuntuacion($dbh, $id_usuario, $puntuacion);
    }
?>