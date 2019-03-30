<?php
	session_start();
	require_once("util.php");

	if(isset($_SESSION["idUsuario"]) && allowed(45)) {
		include 'partials/_header.html';
		include "partials/reportes.html";
		footerhtml();
	} else {
	  header("location: ../index.php");
	}

?>
