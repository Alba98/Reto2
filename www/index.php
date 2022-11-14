<?php 
session_start();
require ('./db_functions.php');
require('VIEWS/PARTIALS/header.php');
?>

        
<?php
// SI NO TIENE CREADA UNA SESIÓN...
if (!isset($_SESSION['id_usu'])) {
    require('VIEWS/login.php');

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
} else { // SI TIENE UNA SESIÓN INICIADA
    echo '<p>El id del usuario es: ' . $_SESSION['id_usu'] .'</p>';
    //require('VIEWS/visualizarPreguntas.php');
}
?>

<?php require('VIEWS/PARTIALS/footer.php') ?>
