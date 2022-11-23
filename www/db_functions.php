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

    //$stmt = $dbh->prepare("SELECT * FROM ${tabla}");
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
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getVistaPreguntasPorUsuario($dbh, $id_usuario) {
    $stmt = $dbh->prepare("SELECT v.* FROM vistaPreguntas v, USUARIO u WHERE v.usuario = u.nombre AND u.nombre = :id");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([
        ':id' => $id_usuario
    ]);
    return $stmt->fetchAll();
}

function getVistaPregunta($dbh, $id_preg) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_preg = :id_preg");
    $data = array(
        "id_preg" => $id_preg
    );
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getVistaRespuestas($dbh, $id_preg) {
    $stmt = $dbh->prepare("SELECT * FROM vistaRespuestas WHERE id_preg = :id");
    $data = array(
        "id" => $id_preg
    );
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute($data);
    return $stmt->fetchAll();
}
// FUNCIONES PARA LA BUSQUEDA CON FILTROS
function getPreguntasCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasVistas($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY vistos DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMenosVistas($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY vistos");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMasLike($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY likes DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMenosLike($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY likes");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMasRespuestas($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY respuestas DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMenosRespuestas($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY respuestas");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMasRecientes($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY fecha DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMenosRecientes($dbh) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas ORDER BY fecha");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPreguntasMasVistasCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY vistos DESC");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosVistasCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY vistos");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasLikeCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY likes DESC");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosLikeCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY likes");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasRespuestasCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY respuestas DESC");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosRespuestasCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY respuestas");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}


function getPreguntasMasRecientesCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY fecha DESC");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosRecientesCategoria($dbh, $categoria) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat ORDER BY fecha");
    $data = array(
        "id_cat" => $categoria
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasVistasBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY vistos DESC");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosVistasBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY vistos");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasLikeBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY likes DESC");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosLikeBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY likes");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasRespuestasBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY respuestas DESC");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosRespuestasBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY respuestas");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasRecientesBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY fecha DESC");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosRecientesBuscar($dbh, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE titulo LIKE :buscar ORDER BY fecha");
    $data = array(
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasVistasCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY vistos DESC");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosVistasCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY vistos");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasLikeCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY likes DESC");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosLikeCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY likes");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMasRespuestasCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY respuestas DESC");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosRespuestasCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY respuestas");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}


function getPreguntasMasRecientesCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY fecha DESC");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasMenosRecientesCategoriaBuscar($dbh, $categoria, $buscar) {
    $stmt = $dbh->prepare("SELECT * FROM vistaPreguntas WHERE id_cat = :id_cat AND titulo LIKE :buscar ORDER BY fecha");
    $data = array(
        "id_cat" => $categoria,
        "buscar" => '%'.$buscar.'%'
    );
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function getPreguntasTodosFiltros($dbh){
    $consulta  = "SELECT * 
        FROM vistaPreguntas 
        WHERE titulo LIKE" + '%'.$buscar.'%' +
        "AND id_cat = :id_cat
        ORDER BY " + orderBy();
    $stmt = $dbh->prepare($consulta);
   
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute($data);
    return $stmt->fetchAll();
}

function orderBy() {
    if (isset($_GET['order'])) {
        if ($_GET['order'] == "masvistas") {
            return "vistos DESC";
        } elseif ($_GET['order'] == "menosvistas") {
            return "vistos";
        } elseif ($_GET['order'] == "masvotadas") {
            return "votos DESC";
        } elseif ($_GET['order'] == "menosvotadas") {
            return "votos";
        } else {
            return "fecha";
        }
    }
}

/*************************************************************************************/
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
        if (isset($_POST['archivo'])) {
            $revisar = getimagesize($_FILES["archivo"]["tmp_name"]);
            if($revisar !== false){
                $image = $_FILES['archivo']['tmp_name'];
                $imgContenido = addslashes(file_get_contents($image));
                $stmt = $dbh->prepare("INSERT INTO RESPUESTA(descripcion,id_preg,archivo)
                               VALUES (:descripcion,:id_preg,'$imgContenido')");
                $stmt->execute($datosRespuesta);
        }
        } else {
            //insertar respuesta 
            $stmt = $dbh->prepare("INSERT INTO RESPUESTA(descripcion,id_preg)
            VALUES (:descripcion,:id_preg)");
            $stmt->execute($datosRespuesta);
        }
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
        /*
        $nombre_archivo = $_FILES['parchivo']['name'];
        $tipo_archivo = $_FILES['parchivo']['type'];
        $tamagno_archivo = $_FILES['parchivo']['size'];


        $revisar = getimagesize($_FILES["parchivo"]["tmp_name"]);
        $image = $_FILES['parchivo']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));
        $stmt = $dbh->prepare("INSERT INTO PREGUNTA(titulo,detalle,id_cat,archivo)
                        VALUES (:titulo, :detalle, :categoria, :img)");
        $datosPregunta['img'] = $imgContenido;
        $stmt->execute($datosPregunta); */

        //insertar pregunta 
        $stmt = $dbh->prepare("INSERT INTO PREGUNTA(titulo,detalle,id_cat)
        VALUES (:titulo, :detalle, :categoria)");
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

function updateVisto($dbh,$id_preg) {
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

function insertarLike($dbh,$id_preg) {
    try {
        $stmt = $dbh->prepare("INSERT INTO GUSTAR (id_usu, id_preg) VALUES (:usuario, :pregunta)");
        $data = array (
            "usuario" => $_SESSION['id_usu'],
            "pregunta" => $id_preg
        );
        $stmt->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function borrarLike($dbh,$id_preg) {
    try {
        $stmt = $dbh->prepare("DELETE FROM GUSTAR WHERE id_usu = :usuario AND id_preg = :pregunta");
        $data = array (
            "usuario" => $_SESSION['id_usu'],
            "pregunta" => $id_preg
        );
        $stmt->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function insertarVoto($dbh,$id_preg) {
    try {
        $stmt = $dbh->prepare("INSERT INTO VOTAR (id_usu, id_res) VALUES (:usuario, :respuesta)");
        $data = array (
            "usuario" => $_SESSION['id_usu'],
            "respuesta" => $id_preg
        );
        $stmt->execute($data);
    } catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

function borrarVoto($dbh,$id_preg) {
    try {
        $stmt = $dbh->prepare("DELETE FROM VOTAR WHERE id_usu = :usuario AND id_res = :respuesta");
        $data = array (
            "usuario" => $_SESSION['id_usu'],
            "respuesta" => $id_preg
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
