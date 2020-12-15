<?php 
require_once 'consultas.php';
session_start();
if(isset($_POST["user"]) and isset($_POST["pass"]) and isset($_POST["mail"])){
    $username = $_POST["user"];
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];
    $validPass = $_POST["validPass"];

    if(validUsername($username)){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            if($pass == $validPass){
                if(userNotRegistered($username)){
                    if(mailNotRegistered($mail)){
                        if(registerNewUser($username,$mail,$pass)){
                            $_SESSION["user-id"] = getUserID($username);
                            $_SESSION["user"] = $username;
                            $_SESSION["user-mail"] = $mail;
                            $_SESSION["message"] = "¡Bienvenido " . $username . "!";
                            $_SESSION["message-type"] = "success";
                            echo 6;
                        }else{
                            echo 0;
                        }
                    }else{
                        echo 5;
                    }
                }else{
                    echo 4;
                }
            }else{
                echo 3;
            }
        }else{
            echo 2;
        }
    }else{
        echo 1;
    }
}else{
    echo 0;
}