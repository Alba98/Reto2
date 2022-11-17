<?php
    if (isset($_POST['id_preg'])) {
<<<<<<< HEAD
         $dbh = connect();
=======
        $dbh = connect();
>>>>>>> develop
        updateVisto($dbh, $_POST['id_preg']);
    }
?>