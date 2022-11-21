<?php
    require ('../db_functions.php');

    $dbh = connect();

    function api_getPreguntas(){
        global $dbh;

        $preguntas = [];

        $order = isset($_GET['order']) ? $_GET['order'] : null;
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;

        switch ($order) {
            case 'masVistas':
                if($categoria)
                    $preguntas = getPreguntasMasVistasCategoria($dbh, $categoria);
                else
                    $preguntas = getPreguntasMasVistas($dbh);
                break;
            case 'menosVistas':
                if($categoria)
                    $preguntas = getPreguntasMenosVistasCategoria($dbh, $categoria);
                else
                    $preguntas = getPreguntasMenosVistas($dbh);
                break;
            case 'masVotadas':
                if($categoria)
                    $preguntas = getPreguntasMasLikeCategoria($dbh, $categoria);
                else
                    $preguntas = getPreguntasMasLike($dbh);
                break;
            case 'menosVotadas':
                if($categoria)
                    $preguntas = getPreguntasMenosLikeCategoria($dbh, $categoria);
                else
                    $preguntas = getPreguntasMenosLike($dbh);
                break;
            case 'masRespuestas':
                // if($categoria)
                //     $preguntas = getPreguntasMasLikeCategoria($dbh, $categoria);
                // else
                //     $preguntas = getPreguntasMasLike($dbh);
                break;
            case 'menosRespuestas':
                // if($categoria)
                //     $preguntas = getPreguntasMenosLikeCategoria($dbh, $categoria);
                // else
                //     $preguntas = getPreguntasMenosLike($dbh);
                break;
            case 'masRecientes':
                if($categoria)
                    $preguntas = getPreguntasMasRecientesCategoria($dbh, $categoria);
                else
                    $preguntas = getPreguntasMasRecientes($dbh);
                break;
            case 'menosRecientes':
                if($categoria)
                    $preguntas = getPreguntasMenosRecientesCategoria($dbh, $categoria);
                else
                    $preguntas = getPreguntasMenosRecientes($dbh);
                break;
            default:
                if(is_null($categoria))
                    $preguntas;
                else
                    $preguntas = getPreguntasCategoria($dbh, $categoria);
                break;
        }

        // $preguntas = getVistaPreguntas($dbh);

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