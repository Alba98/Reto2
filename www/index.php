<?php 
session_start();
require('VIEWS/PARTIALS/header.php') ?>
        
<?php 
require('VIEWS/login.php');
require ('./db_functions.php');

if (isset($_POST['email']) && isset($_POST['pswd'])) {
    $inicio = userLogin($_POST['email'],$_POST['pswd']); // Si es TRUE es correcto
    if ($inicio) {
        echo 'Inicio de sesión hecho correctamente';
    } else echo 'Contraseña o email no validos';
}

?>

<?php require('VIEWS/PARTIALS/footer.php') ?>
