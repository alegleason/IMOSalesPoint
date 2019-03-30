 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && (allowed(37) || allowed(38))) {
    include 'partials/_header.html';
    include "partials/pedidos.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
