<?php
function cn(){

    $server="localhost";
    $user="root";
    $password="";
    $bd="bd_encuestas";

    return mysqli_connect($server,$user,$password,$bd);
}



