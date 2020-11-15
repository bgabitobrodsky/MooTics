<?php
require_once 'cn.php';

function getPregunta($id_encuesta){
    $bd = cn();
    $sql = "SELECT descripcion FROM encuesta WHERE id = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s",$id_encuesta);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result){
        mysqli_close($bd);
        return mysqli_fetch_assoc($result)["descripcion"];
    }else{
        mysqli_close($bd);
        return null;
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
    mysqli_close($bd);
    return $opciones;
}

function getEncuesta($id_encuesta){
    if($datos["pregunta"] = getPregunta($id_encuesta)){
        $datos["opciones"] = getOpciones($id_encuesta);
        return $datos;
    }
    return null;
}

function sumarVoto($id_opcion,$ip){
    $bd = cn();

    //$sql = "INSERT INTO voto VALUES (?, INET_ATON(?))";
    $sql = "INSERT INTO voto VALUES (?, HEX(INET6_ATON(?)))";
    
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss",$id_opcion,$ip);
    $stmt->execute();
    $result = $stmt->get_result();
    mysqli_close($bd);
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
    mysqli_close($bd);

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

    mysqli_close($bd);
    
    return mysqli_num_rows($result)>0;
}

function getIP() {
    //return "2803:9800:a095:94ee:3957:cb15:78c7:3e4";
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}