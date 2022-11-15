<?php
    function optionsCategoria() {
        echo '<option value="C00">- SELECIONE UNA -</option>';
        $dbh = connect();
        $categorias = getAll($dbh, "categoria");

        foreach ($categorias as $categoria) {
            echo '<option>'.$categoria->nombre.'</option>';
        }
    }
?>