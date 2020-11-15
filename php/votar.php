<?php
require_once 'consultas.php';
session_start();

if(isset($_POST["id_encuesta"])){
    $ip = getIP();
    $op = $_POST["opcion"];
    $result = sumarVoto($op,$ip);
}

header("Location: ../?e={$_POST["id_encuesta"]}");