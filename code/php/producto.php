<?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && allowed(35)) {
    include 'partials/_header.html';
    include "partials/producto.html";
    include "partials/_footer.html";
  } else {
    header("location: ../index.php");
  }

?>
