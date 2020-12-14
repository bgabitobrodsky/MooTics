<?php
require_once 'cn.php';
require_once 'consultas.php';
session_start();
if(isset($_SESSION["user-id"])){
	if(isset($_POST["pass"])){
        if(validPass($_POST["pass"],$_SESSION["user-id"])){
            $bd = cn();
			$sql = "DELETE FROM usuario WHERE id = ?";
			$stmt = $bd->prepare($sql);
			$stmt->bind_param("s",$_SESSION["user-id"]);
			$stmt->execute();
            $bd->close();
            session_unset();
            $_SESSION["message"] = "Usuario eliminado";
            $_SESSION["message-type"] = "info";
			echo 2;
        }else{
            echo 1;
        }
	}else{
        echo 0;
    }
}else{
	header("Location: ../login.php");
}