<?php
    function optionsCategoria() {
        echo '<option value="0">- SELECIONE UNA -</option>';
        $dbh = connect();
        $categorias = getAll($dbh, "categoria");

        foreach ($categorias as $categoria) {
            echo '<option value="'.$categoria->id_cat.'">'.$categoria->nombre.'</option>';
        }
    }

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
        }
    }
?>