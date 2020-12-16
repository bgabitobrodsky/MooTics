<?php
require_once 'cn.php';

function getPregunta($id_encuesta){
    $bd = cn();
    $sql = "SELECT * FROM encuesta WHERE id = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$id_encuesta);
    $stmt->execute();
    $result = $stmt->get_result();
    $bd->close();
    if($result){
        return $result;
    }
}

function getOpciones($id_encuesta){
    $bd = cn();
    $sql = "SELECT
                opcion.id,
                opcion.descripcion,
                (SELECT count(*) FROM voto WHERE voto.id_opcion = opcion.id) votos
            FROM opcion
            WHERE id_encuesta = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$id_encuesta);
    $stmt->execute();
    $result = $stmt->get_result();
    $opciones = [];
    while ($opcion = mysqli_fetch_row($result)) {
        $opciones[] = ["id" => $opcion[0], "opcion" => $opcion[1], "votos" => $opcion[2]];
    }
    $bd->close();
    return $opciones;
}

function getEncuesta($id_encuesta){
    $result = getPregunta($id_encuesta);
    if(mysqli_num_rows($result)>0){
        $data = mysqli_fetch_assoc($result);
        $datos["id"] = $data["id"];
        $datos["paused"] = $data["paused"];
        $datos["pregunta"] = $data["descripcion"];
        $datos["created_by"] = $data["created_by"];
        $datos["public"] = $data["public"];
        $datos["opciones"] = getOpciones($id_encuesta);
        return $datos;
    }
    return null;
}

function getEncuestas($id_user){
    $bd = cn();
    $sql = "SELECT * FROM encuesta WHERE created_by = '$id_user' ORDER BY created_at DESC";
    $result = mysqli_query($bd,$sql);
    $bd->close();
    return $result;
}

function sumarVoto($id_opcion,$ip){
    $bd = cn();

    //$sql = "INSERT INTO voto VALUES (?, INET_ATON(?))";
    $sql = "INSERT INTO voto VALUES (?, HEX(INET6_ATON(?)))";
    
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss",$id_opcion,$ip);
    $stmt->execute();
    $result = $stmt->get_result();
    $bd->close();
    return $result;
}

function totalDeVotos($id_encuesta){
    $bd = cn();
    $sql = "SELECT
            sum(votos) votos
        from(
            SELECT
                (SELECT count(*) FROM voto WHERE voto.id_opcion = opcion.id) votos
            FROM opcion
            WHERE opcion.id_encuesta = ?
        ) AS totales";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$id_encuesta);
    $stmt->execute();
    $result = $stmt->get_result();
    $bd->close();

    return mysqli_fetch_array($result);
}

function yaVoto($id_encuesta,$ip){
    $bd = cn();
    $sql = "SELECT
        voto.ip
    FROM opcion
    JOIN voto ON opcion.id = voto.id_opcion and voto.ip = HEX(INET6_ATON(?))
    WHERE id_encuesta = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss",$ip,$id_encuesta);
    $stmt->execute();
    $result = $stmt->get_result();
    $bd->close();

    if(mysqli_num_rows($result)>0){
        $_SESSION["message"] = "¡Ya has votado en esta encuesta!";
        $_SESSION["message-type"] = "secondary";
        return true;
    }else{
        return false;
    }
}

function existeEncuesta($id_encuesta){
    $bd = cn();
    $sql = "SELECT 
                *
            FROM encuesta
            WHERE id = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$id_encuesta);
    $stmt->execute();
    $result = $stmt->get_result();

    $bd->close();
    
    return mysqli_num_rows($result)>0;
}

function encuestaPausada($id_encuesta){
    $data = mysqli_fetch_assoc(getPregunta($id_encuesta));
    return $data["paused"];
}

function getPage(){
    return $_SERVER['REQUEST_URI'];
}

function getIP() {
    //return "2803:9800:a095:94ee:3957:cb15:78c7:3e4";
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}

function registerNewUser($username,$mail,$pass){
    $bd = cn();
    $sql = "INSERT INTO usuario VALUES (null,?,?,SHA1(?))";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("sss",$username,$mail,$pass);
    $stmt->execute();

    $bd->close();

    return $stmt->affected_rows;
}

function getUserID($username){
    $bd = cn();
    $sql = "SELECT 
                id
            FROM usuario
            WHERE user = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    $bd->close();
    
    return (mysqli_fetch_assoc($result)["id"]);
}

function validUsername($str){
    $allowed = array(".", "-", "_");
    return ctype_alnum(str_replace($allowed, '', $str ));
}

function userNotRegistered($user){
    $bd = cn();
    $sql = "SELECT 
                *
            FROM usuario
            WHERE user = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$user);
    $stmt->execute();
    $result = $stmt->get_result();

    $bd->close();
    
    return (mysqli_num_rows($result) == 0);
}

function mailNotRegistered($mail){
    $bd = cn();
    $sql = "SELECT 
                *
            FROM usuario
            WHERE email = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$mail);
    $stmt->execute();
    $result = $stmt->get_result();

    $bd->close();
    
    return (mysqli_num_rows($result) == 0);
}

function validPass($pass,$user){
    $bd = cn();
    $sql = "SELECT 
                *
            FROM usuario
            WHERE id = ? AND password = SHA(?)";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss",$user,$pass);
    $stmt->execute();
    $result = $stmt->get_result();

    $bd->close();
    
    return (mysqli_num_rows($result));
}

function cambiarPass($newPass,$user){
    $bd = cn();
    $sql = "UPDATE 
                usuario
            SET password = SHA(?)
            WHERE id = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss",$newPass,$user);
    $stmt->execute();

    $bd->close();

    return $stmt->affected_rows;
}

function getOpcionColor($i){
    $colores = ["primary","success","warning","danger","info"];
    return $colores[$i%5];
}

function getSearchResults($search){
    $bd = cn();
    $search = "%".$search."%";
    $sql = "SELECT * FROM encuesta WHERE descripcion LIKE ?";

    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$search);
    $stmt->execute();
    $result = $stmt->get_result();
    $bd->close();

    return $result;
}