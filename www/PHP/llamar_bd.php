<?php
    require ('../db_functions.php');

    $dbh = connect();

    function api_getPreguntas(){
        global $dbh;

        $preguntas = [];

        $order = isset($_GET['order']) ? $_GET['order'] : null;
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
        $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : null;

        switch ($order) {
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

    function api_GetPreguntasUsuario() {
        global $dbh;

        $preguntas = getVistaPreguntasPorUsuario($dbh, $_GET['usuario']);

        return $preguntas;
    }


    function api_getPregunta(){
        global $dbh;

        $preguntas = getVistaPregunta($dbh, $_GET['id']);

        return $preguntas;
    }

    function api_getRespuestas(){
        global $dbh;

        $preguntas = getVistaRespuestas($dbh, $_GET['id']);

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