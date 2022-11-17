<?php 
    session_start();
    require ('./db_functions.php');
    require('VIEWS/PARTIALS/header.php');
    require('./PHP/API.php');
?>
        
<?php
    // SI NO TIENE CREADA UNA SESIÓN...
    if (!isset($_SESSION['id_usu'])) {
        require('VIEWS/login.view.php');
        
        // Inicio de sesión
        if (isset($_POST['email']) && isset($_POST['pswd'])) {
            $inicio = userLogin($_POST['email'],$_POST['pswd']); // Si es TRUE es correcto
            if ($inicio) {
                echo '<p style="color:green">Inicio de sesión hecho correctamente</p>';
                // header("Location: index.php?accion=preguntas", TRUE, 301);
                // exit();
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
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'preguntar':
                    $dbh = connect();
                    $infousuario = getUsuario($dbh);
                    require('VIEWS/publicarPregunta.view.php');
                    break;
                case 'detalles':
                    require('VIEWS/detalles.view.php');
                    break;
                case 'perfil':
                    $dbh = connect();
                    $infousuario = getUsuario($dbh);
                    require('VIEWS/perfil.view.php');
                    break;
                case 'cerrarsesion':
                    cerrarSesion();
                    require('VIEWS/login.view.php');
                    break;
                default:
                    require('VIEWS/visualizarPreguntas.view.php');
                    break;
            }
        }
        else {
            require('VIEWS/visualizarPreguntas.view.php');
        }
    }
?>

<?php require('VIEWS/PARTIALS/footer.php') ?>
