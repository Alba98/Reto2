<?php
    if (isset($_REQUEST['id_preg'])) {
        $dbh = connect();
        updateVisto($dbh, $_REQUEST['id_preg']);
    }
?>