<?php
    // Se ejecuta updateUsuario al rellenar los campos necesarios
    if (isset($_POST['titulo']) && isset($_POST['categoria']) && isset($_POST['detalle']) && isset($_POST['archivo'])) {
        if ($_POST['titulo'] != "" && $_POST['categoria'] != "" && $_POST['detalle'] != "") {
            $dbh = connect();
            $data = array (
                "titulo" => $_POST['titulo'],
                "detalle" => $_POST['detalle'],
                "archivo" => $_POST['archivo'],
                "categoria" => $_POST['categoria']
            );
            insertPregunta($dbh, $data);
            $_POST = array();
            cleanURL();
        }
    }

    function cleanURL() {
        // create a new cURL resource
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, '?accion=""');
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // grab URL and pass it to the browser
        curl_exec($ch);

        // close cURL resource, and free up system resources
        curl_close($ch);
    }
?>