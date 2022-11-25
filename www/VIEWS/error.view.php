<?php require('VIEWS/PARTIALS/header.php') ?>

<div class="errores">
    <?php 
        $error = isset($_GET['problema']) ? $_GET['problema'] : null;

        switch ($error) {
            case 'login':
                echo '<h1 style="color:red">Contrase&ntilde;a o email no validos</h1>';
                break;
            case 'registro':
                echo '<h1 style="color:red">Fallo al registrar</h1>';
                break;
            default:
                echo '<h1 style="color:red">Se ha producido un error</h1>';
                break;
        }
    ?>
</div>
    
<?php require('VIEWS/PARTIALS/footer.php') ?>