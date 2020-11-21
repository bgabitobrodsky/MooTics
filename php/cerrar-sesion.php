<?php
session_start();
unset($_SESSION['user-id']);
unset($_SESSION['user']);

$_SESSION["message"] = "Sesión cerrada";
$_SESSION["message-type"] = "secondary";


header("Location: ../login.php");