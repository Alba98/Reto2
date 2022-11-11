<?php require('VIEWS/PARTIALS/header.php') ?>

<?php
    require ('./db_functions.php');
    require ('./VIEWS/login.view.php');
    if (isset($_POST['email']) && isset($_POST['pswd'])) {
        $inicio = userLogin($_POST['email'],$_POST['pswd']);
        if ($inicio) {
            echo 'Inicio de sesión hecho correctamente';
        } else echo 'Contraseña o email no validos';
        
    }
?>
<?php require('VIEWS/PARTIALS/footer.php') ?>
