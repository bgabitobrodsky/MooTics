<?php 
require_once 'consultas.php';
session_start();
if(isset($_SESSION["user-id"])){
    $user_id = $_SESSION["user-id"];
    $res = getEncuestas($user_id);
    $encuestas = [];
    while($row = mysqli_fetch_assoc($res)){
        $encuestas[] = $row;
    }
    echo json_encode($encuestas);
}else{
    header("Location: ../login.php");
}