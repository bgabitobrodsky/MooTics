<?php 
	require_once 'cn.php';
    session_start();
	$bd = cn();

	$question = $_POST['pregunta'];
    $options = $_POST['opciones'];
    
    $options = array_filter($options,function($op){
        return $op != "";
    });

    if($question != "" and count($options) > 0){
        $bytes = openssl_random_pseudo_bytes(8);
        $id_encuesta = bin2hex($bytes);
    
        // agregando la pregunta
        $sql = "INSERT INTO encuesta VALUES (?,?)";
        $stmt = $bd->prepare($sql);
        $stmt->bind_param("ss",$id_encuesta,$question);
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