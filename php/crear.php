<?php 
	require_once 'cn.php';
    session_start();
	$bd = cn();

	$question = $_POST['pregunta'];
    $options = $_POST['opciones'];
    if(!isset($_SESSION["user-id"])){
        $public = true;
    }else{
        $public = $_POST["public"];
        if($public == "true"){
            $public = true;
        }else{
            $public = false;
        }
    }
    
    $options = array_filter($options,function($op){
        return $op != "";
    });

    if($question != "" and count($options) > 0){
        $bytes = openssl_random_pseudo_bytes(8);
        $id_encuesta = bin2hex($bytes);
        if(isset($_SESSION["user-id"])){
            $user_id = $_SESSION["user-id"];
        }else{
            $user_id = null;
        }
        // agregando la pregunta
        $sql = "INSERT INTO encuesta VALUES (?,?,?,CURRENT_TIMESTAMP,0,?)";
        $stmt = $bd->prepare($sql);
        $stmt->bind_param("sssi",$id_encuesta,$question,$user_id,$public);
        $stmt->execute();
    
        // agregando las opciones
        foreach($options as $op){
            if($op!=""){
                $sql = "INSERT INTO opcion VALUES (null, ?,?)";
                $stmt = $bd->prepare($sql);
                $stmt->bind_param("ss",$id_encuesta,$op);
                $stmt->execute();
                mysqli_query($bd,$sql);
            }
        }
        mysqli_close($bd);
        $_SESSION["message"] = "Encuesta creada";
        $_SESSION["message-type"] = "success";
        header("Location: ../?e={$id_encuesta}");
    }else{
        $_SESSION["message"] = "Complete la encuesta";
        $_SESSION["message-type"] = "danger";
        header("Location: ../");
    }