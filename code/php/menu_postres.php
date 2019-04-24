<?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && allowed(53)) {
    include 'partials/_header.html';
    include 'partials/menu_postres.html';
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
