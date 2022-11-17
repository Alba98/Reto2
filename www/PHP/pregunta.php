<?php
    if (isset($_POST['id_preg'])) {
        $dbh = connect();
        updateVisto($dbh, $_POST['id_preg']);
    }
    
?>