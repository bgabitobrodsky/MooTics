<?php
require_once 'cn.php';
require_once 'consultas.php';
session_start();
if(isset($_SESSION["user-id"])){
	if(isset($_POST["id_encuesta"])){
		$id_encuesta = $_POST["id_encuesta"];
		$result = mysqli_fetch_assoc(getPregunta($id_encuesta));
		if($result['created_by'] == $_SESSION['user-id']){
			$bd = cn();
			$sql = "DELETE FROM encuesta WHERE id = ?";
			$stmt = $bd->prepare($sql);
			$stmt->bind_param("s",$id_encuesta);
			$stmt->execute();
			$bd->close();
			$_SESSION["message"] = "Encuesta eliminada";
        	$_SESSION["message-type"] = "success";
			echo 1;
		}
	}
}else{
	header("Location: ../login.php");
}
