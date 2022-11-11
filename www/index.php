<?php require('VIEWS/PARTIALS/header.php') ?>
 
<?php 
   // Si el usuario ha accedido correctamente, mostramos el mensaje de bienvenida:
    if (isset($_SESSION["login"]) && $_SESSION["login"] == 0) {
        $nombre = $usuarios[$_SESSION['usuario']]['nombre'];
        $password = $usuarios[$_SESSION['usuario']]['password'];
        // Cargar la vista
        require('VIEWS/visualizarPreguntas.view.php');
    } else {
        // if($_SESSION["login"] != -1) {
        //     // Si ha habido un error, guardamos el mensaje de error para mostrarlo en la vista.
        //     $mensaje_error = $ERROR_TYPES[$_SESSION["login"]];
        //     // Cargar la vista
        //     require('VIEWS/login.view.php') 
        // }
        // else {
        //     // Cargar la vista con el formulario por primera vez
        //     require('VIEWS/login.view.php') 
        // }
        require('VIEWS/login.view.php');
        //require('VIEWS/visualizarPreguntas.view.php');
    }

?>

<?php require('VIEWS/PARTIALS/footer.php') ?>
