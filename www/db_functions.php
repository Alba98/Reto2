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

function getByName($dbh,$nombre){
    
    $stmt = $dbh->prepare("SELECT * FROM usuario WHERE nombre =:nombre");
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $data = array(
        "nombre" =>$nombre
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

