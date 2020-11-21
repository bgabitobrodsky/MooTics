<?php 
require_once 'cn.php';
require_once 'consultas.php';
session_start();

if(isset($_SESSION['user-id'])){
    $bd = cn();
    $id_encuesta = $_POST['id_encuesta'];
    $id_user = $_SESSION['user-id'];

    if(encuestaPausada($id_encuesta)){
        $sql = "UPDATE encuesta SET paused = 0 WHERE id = ? and created_by = ?";
        $paused = 1;
    }else{
        $sql = "UPDATE encuesta SET paused = 1 WHERE id = ? and created_by = ?";
        $paused = 0;
    }

    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss",$id_encuesta,$id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $bd->close();

    
        if($paused){
            echo "pause";
        }else{
            echo "play";
        }
    
}else{
    header('Location: ../login.php');
}
