<?php 
require_once 'consultas.php';
session_start();
if(isset($_SESSION["user-id"])){
    if(isset($_GET["e"])){
        $encuesta = getEncuesta($_GET["e"]);
        if($encuesta["created_by"] == $_SESSION["user-id"]){
            echo json_encode($encuesta);
        }else{
            echo 0;
        }
    }
}else{
    header("Location: ../login.php");
}