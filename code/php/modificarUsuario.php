<?php
	  session_start();
	  require_once("util.php");
	  if(isset($_SESSION["idUsuario"]) && allowed(47)) {
        include 'partials/_header.html';
        include "partials/modificarUsuario.html";
        footerhtml();
      } else {
        header("location: ../index.php");
      }
?>
