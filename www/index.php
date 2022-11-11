<?php 
session_start();
require('VIEWS/PARTIALS/header.php') ?>
        
<?php 
require('VIEWS/login.php');
require ('./db_functions.php');

// Inicio de sesión
if (isset($_POST['email']) && isset($_POST['pswd'])) {
    $inicio = userLogin($_POST['email'],$_POST['pswd']); // Si es TRUE es correcto
    if ($inicio) {
        echo '<p style="color:green">Inicio de sesión hecho correctamente</p>';
    } else echo '<p style="color:red">Contraseña o email no validos</p>';
}

// Registrarse
if (isset($_POST['remail']) && isset($_POST['rpswd']) && isset($_POST['rnombre'])) {
    $registro = userRegistration($_POST['rnombre'],$_POST['remail'],$_POST['rpswd']); // Si es TRUE es correcto
    if ($registro) {
        echo '<p style="color:green">Registro hecho correctamente</p>';
    } else echo '<p style="color:red">Fallo al registrar</p>';
}

?>

<?php require('VIEWS/PARTIALS/footer.php') ?>
