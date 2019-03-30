<?php
session_start();

require_once("util.php");

include 'partials/_header.html';

$error = "";
    //Starting the session
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flag = 0;
    if(isset($_POST["idUsuario"]) && isset($_POST["password"])) {
        $user = htmlspecialchars($_POST["idUsuario"]);
        $password = htmlspecialchars($_POST["password"]);
        $passHashed = getPasswordHashed($user);
        if($flag == 1){
            if (checkMatch($user, $password)) {
            $_SESSION["idUsuario"] = $_POST["idUsuario"];//assigning the name recieved from the POST variable
            obtainUserInfo($_SESSION["idUsuario"]);
              if(allowed(50)) {
                  header("Location: principal.php");
              } else {
                header("Location: inicio.php");
              }
            }else{
              $error = "<p class='red lighten-2'>Usuario y/o contraseña incorrectos</p>";
              include 'partials/login.html';
            }
        }else if($flag == 0){
            if (password_verify($password, $passHashed)) {
            $_SESSION["idUsuario"] = $_POST["idUsuario"];//assigning the name recieved from the POST variable
            obtainUserInfo($_SESSION["idUsuario"]);
              if(allowed(50)) {
                  header("Location: principal.php");
              } else {
                header("Location: inicio.php");
              }
            }else{
              $error = "<p class='red lighten-2'>Usuario y/o contraseña incorrectos</p>";
              include 'partials/login.html';
            }
        }
        
    }else {
      include 'partials/login.html';
    }
 } else {
    include 'partials/login.html';
 }
include 'partials/_footer.html';
?>
