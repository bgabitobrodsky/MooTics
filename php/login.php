<?php
require_once 'cn.php';
session_start();
if(isset($_POST["user"]) and isset($_POST["pass"])){
    $user = strtolower($_POST["user"]);
    $password = $_POST["pass"];
    $bd = cn();
    $sql = "SELECT * FROM usuario WHERE user = ? and password = SHA(?)";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("ss",$user,$password);
    $stmt->execute();
    $result = $stmt->get_result();
    if(mysqli_num_rows($result) > 0){
        $datos = $result->fetch_assoc();
        $_SESSION['user-id'] = $datos["id"];
        $_SESSION['user'] = $datos["user"];
        $_SESSION['user-mail'] = $datos["email"];
        echo 2;
    }else{
        echo 1;
    }
}else{
    echo 0;
    header("Location: login.php");
}