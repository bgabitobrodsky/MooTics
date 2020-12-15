<?php
require_once 'cn.php';
require_once 'consultas.php';
session_start();
if(isset($_SESSION["user-id"])){
    $curPass = $_POST["current-pass"];
    $newPass = $_POST["new-pass"];
    
    if(isset($_POST["new-pass"]) && isset($_POST["current-pass"])){
        $curPass = $_POST["current-pass"];
        $newPass = $_POST["new-pass"];
        if(validPass($curPass,$_SESSION["user-id"])){
            if(cambiarPass($newPass,$_SESSION["user-id"])){
                echo 2;
            }else{
                echo 0;
            }
        }else{
            echo 1;
        }
    }else{
        echo 0;
    }
}else{
	header("Location: ../login.php");
}