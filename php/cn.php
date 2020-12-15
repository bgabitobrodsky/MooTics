<?php
function cn(){
    $server="localhost";
    $user="root";
    $password="";
    $bd="bd_encuestas";

    // $user="id15360862_root";
    // $password="+SP5JN%U#drakKtD";
    // $bd="id15360862_encuestas";
    return mysqli_connect($server,$user,$password,$bd);
}