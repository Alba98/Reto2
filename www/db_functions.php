<?php
/**
 * @author    GRUPO 1 <wat2022.wordpress.com>
 * @version   2022-11-22
 * 
*/

//Conexion BBDD
function connect(){
    $dbname = "reto2";
    $host = "db";
    $username = "root";
    $pass = "db123";

    try {
        # MySQL
        $dbh= new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        return null;
    }
}

function getAll($dbh,$tabla){
    
    $stmt = $dbh->prepare("SELECT * FROM :tabla");
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $data = array("tabla"=>$tabla);
    $stmt->execute($data);

    return $stmt->fetchAll();
}

function getUsuario($dbh){
    $stmt = $dbh->prepare("SELECT * FROM usuario WHERE id_usu =:id_usu");
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $data = array(
        "id_usu" =>$_SESSION['id_usu']
    );
    $stmt->execute($data);

    return $stmt->fetchAll();
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
        $stmt = $dbh->prepare("INSERT INTO respuesta(descripcion)
                               VALUES (:descripcion)");

        $stmt->execute($datosRespuesta);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function insertPregunta($dbh,$datosPregunta){
   
    try {
        $stmt = $dbh->prepare("INSERT INTO pregunta(titulo,detalle,archivo,)
                               VALUES (:descripcion)");

        $stmt->execute($datosRespuesta);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function insertCategoria($dbh,$datosCategoria){
   
    try {
        $stmt = $dbh->prepare("INSERT INTO pregunta(nombre)
                               VALUES (:nombre)");

        $stmt->execute($datosCategoria);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
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
            $_SESSION['logged']=true;
            $_COOKIE['prueba'] = 'HOLA';
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


