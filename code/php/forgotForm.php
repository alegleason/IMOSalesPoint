<?php
session_start();

require_once("util.php");

include 'partials/_header.html';

$error = "";
    //Starting the session
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST["email"])) {
    	$mail = htmlspecialchars($_POST["email"]);
    	echo $mail;
    	$password = getPassword($mail);
    	echo $password;
    	if ($password == false) {
    		echo '<script type="text/javascript">alert("No hay usuario con ese mail!");</script>';
    		header( "refresh:.1; url=forgot.php" );
    	}
    }else {
      include 'partials/login.html';
    }
 } else {
    include 'partials/login.html';
 }
include 'partials/_footer.html';
?>
