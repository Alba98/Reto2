<?php
/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 **/

//Conexion BBDD
function connect(){
    $dbname = "reto2";
    $host = "db";
    $username = "root";
    $pass = "db123";

    try {
        # MySQL
        $dbh= new PDO("mysql:host=$host;dbname=$dbname", $username, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        return null;
    }
}

function getAll($dbh,$tabla){
    $tabla = strtoupper($tabla);
    switch($tabla)
    {
        case 'CATEGORIA':
            $stmt = $dbh->prepare("SELECT * FROM CATEGORIA");
            break;
        case 'PREGUNTA':
            $stmt = $dbh->prepare("SELECT * FROM PREGUNTA");
            break;
        case 'PREGUNTAR':
            $stmt = $dbh->prepare("SELECT * FROM PREGUNTAR");
            break;
        case 'RESPONDER':
            $stmt = $dbh->prepare("SELECT * FROM RESPONDER");
            break;
        case 'RESPUESTA':
            $stmt = $dbh->prepare("SELECT * FROM RESPUESTA");
            break;
        case 'USUARIO':
            $stmt = $dbh->prepare("SELECT * FROM USUARIO");
            break;
        default:
            throw "Tabla no encontrada";
    }
    
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getVistaPreguntas($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas");
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPregunta($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_preg = :id_preg");
    $data = array(
        "id_preg" => $_GET['id']
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getRespuestas($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaRespuestas WHERE id_preg = :id");
    $data = array(
        "id" => $_GET['id']
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function countRespuestas($dbh,$id_preg) {
    $stmt = $dbh->prepare("SELECT * FROM countRespuestas WHERE id_preg = :id");
    $data = array(
        "id" => $id_preg
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetch();
}

function countLikes($dbh,$id_preg) {
    $stmt = $dbh->prepare("SELECT * FROM countLikes WHERE id_preg = :id");
    $data = array(
        "id" => $id_preg
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetch();
}

function countVotos($dbh,$id_res) {
    $stmt = $dbh->prepare("SELECT * FROM countVotos WHERE id_res = :id");
    $data = array(
        "id" => $id_res
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetch();
}

function getUsuario($dbh){
    $stmt = $dbh->prepare("SELECT nombre, apellidos, email, contrasenia, imagen FROM USUARIO WHERE id_usu =:id_usu");
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $id_usuario = $_SESSION['id_usu'];
    $data = array(
        "id_usu" => $id_usuario
    );
    $stmt->execute($data);
    while($row = $stmt->fetch()) {
        $pnombre = $row->nombre;
        $papellidos = $row->apellidos;
        $pemail = $row->email;
        $pcontrasenia = $row->contrasenia;
        $pimagen = $row->imagen;
       }
    $datosusuario = array (
        "nombre" => $pnombre,
        "apellidos" => $papellidos,
        "email" => $pemail,
        "contrasenia" => $pcontrasenia,
        "imagen" => $pimagen
    );
    return $datosusuario;
}

//INSERT DE CADA TABLA
function insertUsuario ($dbh,$datosUsuario){
   
    try {
        $stmt = $dbh->prepare("INSERT INTO usuario (nombre,apellidos,email,contraseña,imagen)
                               VALUES (:nombre, :apellidos, :email, :contraseña, :imagen)");
        $stmt->execute($datosUsuario);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}


function insertRespuesta($dbh,$datosRespuesta){
    try {
        //insertar respuesta 
        $stmt = $dbh->prepare("INSERT INTO RESPUESTA(descripcion)
                               VALUES (:descripcion)");

        $stmt->execute($datosRespuesta);

        //insertar en responder 
        $stmt_ = $dbh->prepare("INSERT INTO RESPONDER(id_usu,id_res)
                                VALUES (:usuario, :respuesta)");
        $data = array (
             "usuario" => $_SESSION['id_usu'],
             "respuesta" => $dbh->lastInsertId()
        );
        $stmt_->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function insertPregunta($dbh, $datosPregunta){
    try {
        //insertar pregunta 
        $stmt = $dbh->prepare("INSERT INTO PREGUNTA(titulo,detalle,archivo,id_cat)
                               VALUES (:titulo, :detalle, :archivo, :categoria)");

        $stmt->execute($datosPregunta);

        //insertar en preguntar 
        $stmt_ = $dbh->prepare("INSERT INTO PREGUNTAR(id_usu,id_preg)
                                VALUES (:usuario, :pregunta)");
        $data = array (
            "usuario" => $_SESSION['id_usu'],
            "pregunta" => $dbh->lastInsertId()
        );
        $stmt_->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function insertCategoria($dbh,$datosCategoria){
   
    try {
        $stmt = $dbh->prepare("INSERT INTO categoria(nombre)
                               VALUES (:nombre)");

        $stmt->execute($datosCategoria);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function updateVisto($dbh, $id_preg) {
    try {
        $stmt = $dbh->prepare("UPDATE PREGUNTA SET visto = visto + 1 WHERE id_preg = :id_preg");
        $data = array (
            "id_preg" => $id_preg
        );
        $stmt->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

// UPDATES
function updateUsuario($dbh) { // UPDATE SIN LA CONTRASEÑA
    try {
        $stmt = $dbh->prepare("UPDATE USUARIO SET nombre = :nombre, apellidos = :apellidos, email = :email WHERE id_usu = :id_usu");
        $data = array (
            "nombre" => $_POST['pnombre'],
            "apellidos" => $_POST['papellidos'],
            "email" => $_POST['pemail'],
            "id_usu" => $_SESSION['id_usu']
        );
        $stmt->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

// Se ejecuta updateUsuario al rellenar los campos necesarios
if (isset($_POST['pnombre']) ||  isset($_POST['papellidos']) || isset($_POST['pemail'])) {
    $dbh = connect();
    updateUsuario($dbh);
}

function updatePass($dbh) {
    try {
        $stmt = $dbh->prepare("UPDATE USUARIO SET contrasenia = :pass WHERE id_usu = :id_usu");
        $data = array (
            "pass" => $_POST['cambiarpass'],
            "id_usu" => $_SESSION['id_usu']
        );
        $stmt->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

// Se ejecuta updateUsuario al rellenar los campos necesarios
if (isset($_POST['cambiarpass']) && $_POST['cambiarpass'] != "") {
    $dbh = connect();
    updatePass($dbh);
}

//SELECT DE CADA TABLA
//de la relacion tambien?
function deletePreguntaById($dbh, $id){
    $data = array(
        'id' => $id
    );
    $stmt = $dbh->prepare("DELETE FROM pregunta WHERE id_preg= :id");
    $stmt->execute($data);
}

// LOGIN
function userLogin($email,$pass){
    try{
        $db = connect();
        $stmt = $db->prepare("SELECT id_usu FROM USUARIO WHERE email=:email AND contrasenia=:pass"); 
        $data = array(
            "email" => $email,
            "pass" => $pass
        );
        $stmt->execute($data);
        $count = $stmt->rowCount();
        $datos = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        if($count){
            $_SESSION['id_usu']=$datos->id_usu; // Guardamos en sesión el id del usuario
            return true;
        }
        else {
            return false;
        } 
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

// REGISTRAR
function userRegistration($nombre,$email,$pass){
    try{
        $db = connect();
        $stmt = $db->prepare("SELECT id_usu FROM USUARIO WHERE email=:email AND contrasenia=:pass"); 
        $data = array(
            "email" => $email,
            "pass" => $pass
        );
        $stmt->execute($data);
        $count=$stmt->rowCount();
        if($count<1) {
            $stmt = $db->prepare("INSERT INTO USUARIO(nombre,contrasenia,email) VALUES (:nombre,:pass,:email)");
            $data = array(
                "email" => $email,
                "pass" => $pass,
                "nombre" => $nombre
            );
            $stmt->execute($data);
            $uid=$db->lastInsertId(); // Ultimo id insertado
            $_SESSION['id_usu']=$uid;
            return true;
        }
        else {
            $db = null;
            return false;
        }
    } 
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

// CERRAR SESIÓN
function cerrarSesion() {
    unset($_SESSION[ "id_usu"]);
}


// OPTIONS CATEGORIA
function optionsCategoria() {
    echo '<option value="0">- SELECIONE UNA -</option>';
    $dbh = connect();
    $categorias = getAll($dbh, "categoria");

    foreach ($categorias as $categoria) {
        echo '<option value="'.$categoria->id_cat.'">'.$categoria->nombre.'</option>';
    }
}