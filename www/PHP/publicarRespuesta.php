<?php
    if (isset($_POST['detalleR']) && isset($_POST['archivo'])) {
        if ($_POST['detalleR'] != "") {
            $dbh = connect();
            $data = array (
                "descripcion" => $_POST['detalleR'],
                "id_preg" => $_GET['id']
                // "archivo" => $_POST['archivo']
            );
            insertRespuesta($dbh, $data);
            $_POST = array();
            //cleanURL();
            //header('?accion=""');
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